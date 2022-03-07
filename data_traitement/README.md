# Big-Cooking-Data
<h4>This project is a submodule and can be found @: https://github.com/IamDiallo/Big-Cooking-Data</h4>
This project has 4 main parts:

<h3>A. Data Scraping</h3>
<h5>Site Web: Marmiton</h5>
<p>1. We use the python library Scrapy. <br/>
Firstly, you need to install the library, full explanation on how to install it <br/>
can be found on: https://scrapy.org/
</p>

<p>2. Once the library is installed you can run the code and generate either a csv or json file using the <br />
command: scrapy crawl marmiton -o test.json or test.json
</p>
<p>3. Further explanation on how the code works is comming soon</p>

<hr>
<h3>B. Data Cleaning</h3>
<p>the data collected are cleaned in order to prepare for the clustering</p>

<h3>C. Data Clustering</h3>
<p>To clust the data we use kmeans, PCA, and other methods to evaluate our algorithms</p>

<h3>C. Data Insertion</h3>
<p>The clustered data will be inserted in a MySql database. The process of this will be explained soon.</p>
