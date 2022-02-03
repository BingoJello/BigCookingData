let ctx = document.getElementById('myChart').getContext('2d');
let ctx2 = document.getElementById('myChart2').getContext('2d');

let colorHex = ['#FB3640', '#EFCA08', '#43AA8B', '#253D5B'];

let myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    datasets: [{
      data: [30, 10, 40, 20],
      backgroundColor: colorHex
    }],
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom'
    },
	events: [],
    plugins: {
      datalabels: {
        color: '#fff',
        anchor: 'end',
        align: 'start',
        offset: -10,
        borderWidth: 2,
        borderColor: '#fff',
        borderRadius: 25,
        backgroundColor: (context) => {
          return context.dataset.backgroundColor;
        },
        font: {
          weight: 'bold',
          size: '10'
        },
        formatter: (value) => {
          return value + ' %';
        }
      }
    }
  }
})

let myChart2 = new Chart(ctx2, {
  type: 'pie',
  data: {
    datasets: [{
      data: [30, 10, 40, 20],
      backgroundColor: colorHex
    }],
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom'
    },
    plugins: {
      datalabels: {
        color: '#fff',
        anchor: 'end',
        align: 'start',
        offset: -10,
        borderWidth: 2,
        borderColor: '#fff',
        borderRadius: 25,
        backgroundColor: (context) => {
          return context.dataset.backgroundColor;
        },
        font: {
          weight: 'bold',
          size: '10'
        },
        formatter: (value) => {
          return value + ' %';
        },
      }
    }
  }
})

document.getElementById("details_nutrition_meal_planner").addEventListener("click",function(){
	if(document.getElementById('popover645179').style.display == "none"){
		document.getElementById('popover645179').style.display='block';
	}
});

function closePopover(){
	if(document.getElementById('popover645179').style.display=="block"){
		document.getElementById('popover645179').style.display="none";
	}
}

function anything(){
	document.getElementById('li-anything').style.backgroundColor = "green";
	document.getElementById('li-paleo').style.backgroundColor = "white";
	document.getElementById('li-vegetarian').style.backgroundColor = "white";
	document.getElementById('li-veganism').style.backgroundColor = "white";
	document.getElementById('li-ketogenic').style.backgroundColor = "white";
	document.getElementById('li-cretois').style.backgroundColor = "white";
	
	document.getElementById('label-anything').style.color="white";
	document.getElementById('label-paleo').style.color="#474747";
	document.getElementById('label-vegetarian').style.color="#474747";
	document.getElementById('label-veganism').style.color="#474747";
	document.getElementById('label-ketogenic').style.color="#474747";
	document.getElementById('label-cretois').style.color="#474747";
}
function paleo(){
	document.getElementById('li-anything').style.backgroundColor = "white";
	document.getElementById('li-paleo').style.backgroundColor = "green";
	document.getElementById('li-vegetarian').style.backgroundColor = "white";
	document.getElementById('li-veganism').style.backgroundColor = "white";
	document.getElementById('li-ketogenic').style.backgroundColor = "white";
	document.getElementById('li-cretois').style.backgroundColor = "white";
	
	document.getElementById('label-anything').style.color="#474747";
	document.getElementById('label-paleo').style.color="white";
	document.getElementById('label-vegetarian').style.color="#474747";
	document.getElementById('label-veganism').style.color="#474747";
	document.getElementById('label-ketogenic').style.color="#474747";
	document.getElementById('label-cretois').style.color="#474747";
}
function vegetarian(){
	document.getElementById('li-anything').style.backgroundColor = "white";
	document.getElementById('li-paleo').style.backgroundColor = "white";
	document.getElementById('li-vegetarian').style.backgroundColor = "green";
	document.getElementById('li-veganism').style.backgroundColor = "white";
	document.getElementById('li-ketogenic').style.backgroundColor = "white";
	document.getElementById('li-cretois').style.backgroundColor = "white";
	
	document.getElementById('label-anything').style.color="#474747";
	document.getElementById('label-paleo').style.color="#474747";
	document.getElementById('label-vegetarian').style.color="white";
	document.getElementById('label-veganism').style.color="#474747";
	document.getElementById('label-ketogenic').style.color="#474747";
	document.getElementById('label-cretois').style.color="#474747";
}
function veganism(){
	document.getElementById('li-anything').style.backgroundColor = "white";
	document.getElementById('li-paleo').style.backgroundColor = "white";
	document.getElementById('li-vegetarian').style.backgroundColor = "white";
	document.getElementById('li-veganism').style.backgroundColor = "green";
	document.getElementById('li-ketogenic').style.backgroundColor = "white";
	document.getElementById('li-cretois').style.backgroundColor = "white";
	
	document.getElementById('label-anything').style.color="#474747";
	document.getElementById('label-paleo').style.color="#474747";
	document.getElementById('label-vegetarian').style.color="#474747";
	document.getElementById('label-veganism').style.color="white";
	document.getElementById('label-ketogenic').style.color="#474747";
	document.getElementById('label-cretois').style.color="#474747";
}
function ketogenic(){
	document.getElementById('li-anything').style.backgroundColor = "white";
	document.getElementById('li-paleo').style.backgroundColor = "white";
	document.getElementById('li-vegetarian').style.backgroundColor = "white";
	document.getElementById('li-veganism').style.backgroundColor = "white";
	document.getElementById('li-ketogenic').style.backgroundColor = "green";
	document.getElementById('li-cretois').style.backgroundColor = "white";
	
	document.getElementById('label-anything').style.color="#474747";
	document.getElementById('label-paleo').style.color="#474747";
	document.getElementById('label-vegetarian').style.color="#474747";
	document.getElementById('label-veganism').style.color="#474747";
	document.getElementById('label-ketogenic').style.color="white";
	document.getElementById('label-cretois').style.color="#474747";
}
function cretois(){
	document.getElementById('li-anything').style.backgroundColor = "white";
	document.getElementById('li-paleo').style.backgroundColor = "white";
	document.getElementById('li-vegetarian').style.backgroundColor = "white";
	document.getElementById('li-veganism').style.backgroundColor = "white";
	document.getElementById('li-ketogenic').style.backgroundColor = "white";
	document.getElementById('li-cretois').style.backgroundColor = "green";
	
	document.getElementById('label-anything').style.color="#474747";
	document.getElementById('label-paleo').style.color="#474747";
	document.getElementById('label-vegetarian').style.color="#474747";
	document.getElementById('label-veganism').style.color="#474747";
	document.getElementById('label-ketogenic').style.color="#474747";
	document.getElementById('label-cretois').style.color="white";
}


$(document).ready(function(){
	$('.diet_draggable').tooltip({
		title: fetchData,
		html: true,
		placement: 'right'
	});

	function fetchData()
	{
		var fetch_data = '';
		var element = $(this);
		var id = element.attr("toogle000001");
		var fetch_data = "<div style='line-height: 20px;font-size: 14px;letter-spacing: 0.3px;padding: 10px' class='tooltip_box'><div style='font-size: 18px;line-height: 20px;padding-bottom: 1px' class='sb_tooltip_title'>Gordon Ramsay's Scrambled Eggs</div><div style='font-style: normal;font-stretch: normal;line-height: normal;' class='tooltip_time text-small'>5 mins prep, 10 mins cook</div><hr style='margin-top: 10px;margin-bottom: 10px;margin-left: -15px;margin-right: -15px;border-color: rgba(255, 255, 255, 0.15);border-top-width: 1px;' class='ingredients_bar'><div style='padding-bottom: 5px; font-size: 12px;font-weight: 500;letter-spacing: 1.5px;text-transform: uppercase;' class='tooltip_units text-label'>Per 1  serving</div><div class='tt_macro_div'><div class='tt_macro tooltip_calories'><div style=' float: left;' class='tt_macro_name'>Calories</div><div style='text-align: right; padding-right: 50px;' class='tt_macro_amt'>444.9</div></div><div style='color: #FCB524;' class='tt_macro tooltip_carbs'><div style='float: left;' class='tt_macro_name'>Carbs</div><div style='text-align: right;padding-right: 50px;' class='tt_macro_amt'>1.4g</div></div><div style='color: #52C0BC;' class='tt_macro tooltip_fats'><div style='float: left;' class='tt_macro_name'>Fat</div><div style='  text-align: right;padding-right: 50px' class='tt_macro_amt'>40.1g</div></div><div style='color: #976fe8;' class='tt_macro tooltip_proteins'><div style='float: left;' class='tt_macro_name'>Protein</div><div style='text-align: right;padding-right: 50px; 'class='tt_macro_amt'>19.3g</div></div></div><hr style=' margin-top: 10px;margin-bottom: 10px;margin-left: -15px;margin-right: -15px;border-color: rgba(255, 255, 255, 0.15);border-top-width: 1px;' class='ingredients_bar'><div class='recipe_ingredients'><div class='ttp_ingredients'><div style=' padding-left: 1.5em;text-indent: -1.5em;' class='ttp_ingredient_amount'>3 large Egg</div><div style=' padding-left: 1.5em;text-indent: -1.5em;' class='ttp_ingredient_amount'>1/2 tbsp Creme fraiche</div><div style='padding-left: 1.5em;text-indent: -1.5em;' class='ttp_ingredient_amount'>2 tbsp Butter</div></div></div></div>";

		return fetch_data;
	}
});