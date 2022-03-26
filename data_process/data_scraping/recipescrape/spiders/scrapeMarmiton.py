#@author mamadou bella DIALLO

import scrapy
from scrapy.linkextractors import LinkExtractor
from scrapy.spiders import CrawlSpider, Rule
import re
import logging

DEBUG = False
FIELDS = [
   'id','nom', 'img_url','time_total', 'time_prepa',
   'time_repo','time_cuisson', 'difficulty', 'budget',
   'numberP','ingredients','id_ingre','nom_ingre', 
   'quantity','image_ingre','titre', 'description', 
   'etape', 'etap_id', 'category','global_rating'
]


def getFloat(x, index=0):
    # extracts only the numerical portion of text
    try:
        return float(re.findall(r'[-+]?[0-9]*\.?[0-9]+', x)[index])
    except:
        return 0.0


def getText(x, index=0, toLower=False):
    # extracts only the alphabetical portion of text
    temp = []
    try:
        for world in x:
            if(world!="\xa0"):
                temp.append(world)
        return temp

    except:
        return 'error'


def delSpaces(x):
    # strips and removes annoying carriage returns
    listQty =[]
    for i in x:
       if(i!="\xa0"):
        listQty.append(i)
    return listQty

class Marmiton(CrawlSpider):
    name = 'marmiton'
    allowed_domains = ['marmiton.org']

    start_urls = [ 
        # 'https://www.marmiton.org/recettes?type=platprincipal',
        #  'https://www.marmiton.org/recettes?type=boisson',
        #  'https://www.marmiton.org/recettes/index/categorie/aperitif-ou-buffet?rcp=0'
        #   'https://www.marmiton.org/recettes?page=2',
         'https://www.marmiton.org/recettes?type=dessert'
        ]
    
    # first get the next button which will visit every page of a category
    rule_next = Rule(LinkExtractor(
                    restrict_xpaths=('.//nav[@class="af-pagination"]/ul/li/a')
                    ),
                    follow=True,
                    )

     # secondly # Extract links matching 'recipe' and parse them with the spider's method parse_item
    rule_recipe = Rule(LinkExtractor(allow=('https://www.marmiton.org/recettes/'), unique=True),
                       callback='parse_item',
                       follow=True,
                       )
    rules = (rule_recipe, rule_next)
    item_index =-1
    item_index = 2079
    def parse_item(self, response):
        ingre_table = []
        etape_tab = []
        if DEBUG:
            self.state['items_count'] = self.state.get('items_count', 0) + 1
            self.log(
                f"{self.state['items_count']} {response.url}", logging.WARN)
        try:
            img = response.css(".SHRD__sc-dy77ha-0.vKBPb::attr(src)").extract_first()
            print("------------------------",img)
            img = img.split("/")
            img5 = img[5].split("_")
           
            if len(img5) >=4:
                img_url = img[0] + "//" + img[2] + "/" +img[3] + "/"+ img[4] + "/" + img5[0] + "_" + img5[1] + "_" + img5[2] + "_" + img5[3] + "_" + "w1000h1000.jpg"
            else:
                img_url = img[0] + "//" + img[2] + "/" +img[3] + "/"+ img[4] + "/" + img5[0] + "_" + "w1000h1000.jpg"

            # print("----------------RECETTES--------------------")
            # img_recette_source = response.xpath('.//picture[@class="SHRD__sc-1rqpopx-1 kNPyTk"]/source/@srcset').getall()
            # if img_recette_source == None:
            #     img_recette_source = response.xpath('.//picture[@class="RCP__sc-40fnuy-0 dslNWH"]/source/@srcset').getall()
            #     if img_recette_source == None:
            #         img_recette_source = response.xpath('.//picture[@class=" RCP__sc-vgpd2s-2 fNmocT"]/source/@srcset').getall()
            #         if  img_recette_source == None:
            #             img_recette_source = "no image"  
            # img_recette_source = img_recette_source[0]
            # img_recette_source = img_recette_source.split(',')
            # img_recette_source = img_recette_source[-1]
            # img_recette_source = img_recette_source.split(' ')
            # img_recette_source = img_recette_source[1]

            
            name = response.css('h1.SHRD__sc-10plygc-0.itJBWW::text').get()
            infosRecette  = response.xpath('.//span[@class="SHRD__sc-10plygc-0 cBiAGP"]/p/text()').getall()
            time = response.xpath('.//span[@class="SHRD__sc-10plygc-0 bzAHrL"]/text()').getall()
            time_prepa = time[1]
            time_repo = time[2]
            time_cuisson = time[3]
            time = infosRecette[0]
            difficulty = infosRecette[1]
            budget = infosRecette[2]
            number_people = 1
            categories = response.xpath('.//span[@class="SHRD__sc-10plygc-0 duPxyD"]/text()').getall()
            del categories[0]
            # del categories[0]
            if len(categories) > 2:
                # del categories[1]
                categories.pop(0)
            del categories[-1]
            global_rating = response.xpath('.//span[@class="SHRD__sc-10plygc-0 jHwZwD"]/text()').get()
            etapes = response.css('div.SHRD__sc-juz8gd-3')
            etape_infos = etapes.css("ul li")
            for i, etape in enumerate(etape_infos):
                # titre = etape.xpath('.//div[@class="RCP__sc-1wtzf9a-0 hXKiLp"]/h3/text()').get()
                description = etape.xpath('.//p[@class="RCP__sc-1wtzf9a-3 jFIVDw"]/text()').get()
                # etape_dic = {'etap_id':i,'titre':titre, 'description':description}
                etape_tab.append(description)

            infos_ingre = response.css('div.MuiGrid-root')

            for index, link in enumerate(infos_ingre):
                img_ingre_url = link.xpath('.//div[@class="RCP__sc-vgpd2s-2 fNmocT"]/picture/img/@src').get()
                #problem à resoudre
                # qty_ingre = link.xpath('.//span[@class="SHRD__sc-10plygc-0 epviYI"]/text()').extract_first()
            
               
                nom_ingre = link.xpath('.//span[@class="RCP__sc-8cqrvd-3 itCXhd"]/text()').get()
                qty = link.css('span.epviYI::text').get()
                qty_ingre = link.xpath('.//span[@class="SHRD__sc-10plygc-0 epviYI"]/text()').getall()
                if(nom_ingre == None):
                    nom_ingre = link.xpath('.//span[@class="RCP__sc-8cqrvd-3 cDbUWZ"]/text()').get()
                if(qty_ingre == None):
                    qty_ingre = 'empty'
                if index !=0:
                    # ingre_dic={"id_ingre":index,"nom_ingre":nom_ingre,"quantity":qty_ingre,"image_ingre":img_ingre_url}
                    ingre_dic={"id_ingre":index,"nom_ingre":nom_ingre,"quantity":qty_ingre,"image_ingre":img_ingre_url}
                    ingre_table.append(ingre_dic)
        except:
              print('error: on selecting info')
        self.item_index += 1
        data = {
                'id':self.item_index,
                'nom':name,
                'img_url': img_url,
                'category': categories,
                'global_rating':global_rating,
                'time_prepa': time_prepa, 
                'time_repo': time_repo, 
                'time_cuisson': time_cuisson, 
                'difficulty':difficulty, 
                'budget':budget ,
                'numberP':number_people ,
                'etape':etape_tab,
                'ingredients' :ingre_table,
                

           }
        dataDic = {}
        dataDic.update(data)
        yield dataDic