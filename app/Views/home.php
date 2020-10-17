<!DOCTYPE HTML>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.webix.com/edge/webix.css"type="text/css">
    <script src="https://cdn.webix.com/edge/webix.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.7.94/css/materialdesignicons.css?v=8.0.0" type="text/css" charset="utf-8">
    <style>
			.transparent{
				background-color: transparent;
			}
			a.check_flight{
				color:  #367ddc;
			}
			.webix_row_select a.check_flight{
				color:  #fff;
			}
			.blue_row{
				background-color: #cbdeeb !important;
			}
			.blue_row .webixtype_form{
				font-size: 18px;
			}
			.main_title{
				font-size:20px;
			}
		</style>
		<title>Inicio</title>
    </head>
    <body>

	<script type="text/javascript">

		

		var cities = [
			{id:1, value:"Berlin"}, {id:2, value:"Kiev"}, {id:3, value:"Minsk"},
			{id:4, value:"Moscow"}, {id:5, value:"Prague"}, {id:6, value:"Riga"},
			{id:7, value:"St.Petersburg"}, {id:8, value:"Tallin"}, {id:9, value:"Vilnius"},{id:10, value:"Warsaw"}
		];
		var hours = [];
		for(var i=0; i< 24;i++){
			hours.push(i<10?("0"+i):""+i);
		}
		var minutes = [];
		for(var i=0; i< 60;i += 15){
			minutes.push(i<10?("0"+i):""+i);
		}


		var offers = [
			{id:1, direction:"<span class='webix_strong'>Tallin</span> EE - <span class='webix_strong'>Berlin</span> Tegel DE", date:new Date(2014,7,25), price:"450", save:"45", places:21},
			{id:2, direction:"<span class='webix_strong'>Moscow</span> Vnukovo RU - <span class='webix_strong'>Kiev</span> Borispol UA", date: new Date(2014,7,28), price:"160", save:"65", places:5},
			{id:3, direction:"<span class='webix_strong'>Riga</span> International LV - <span class='webix_strong'>Warsaw</span> Modlin", date: new Date(2014,7,16), price:"220", save:"110", places:2},
			{id:4, direction:"<span class='webix_strong'>Vilnius</span> LT - <span class='webix_strong'>Kiev</span> Zhulhany UA", date: new Date(2014,8,1), price:"140", save:"40", places:35},
			{id:5, direction:"<span class='webix_strong'>Minsk</span> International 2 BY- <span class='webix_strong'>Berlin</span> Schoenefeld DE", date: new Date(2014,8,6), price:"378", save:"35", places:25},
			{id:6, direction:"<span class='webix_strong'>St. Petersburg</span> Pulkovo - <span class='webix_strong'>Tallin</span> Estonia", date: new Date(2014,7,31), price:"90", save:"82", places:11},
			{id:7, direction:"<span class='webix_strong'>Kiev</span> Zhulhany UA - <span class='webix_strong'>Moscow</span> Vnukovo RU", date: new Date(2014,8,15), price:"220", save:"30", places:41},
			{id:8, direction:"<span class='webix_strong'>Moscow</span> Sheremetyevo RU - <span class='webix_strong'>Vilnius</span> LT", date: new Date(2014,8,11), price:"321", save:"44", places:32},
			{id:9, direction:"<span class='webix_strong'>Warsaw</span> PL - <span class='webix_strong'>Minsk</span> International 2 BY", date: new Date(2014,8,5), price:"256", save:"32", places:55},
			{id:10, direction:"<span class='webix_strong'>Prague</span> CZ - <span class='webix_strong'>St. Petersburg</span> Pulkovo", date: new Date(2014,7,30), price:"311", save:"63", places:15},
			{id:11, direction:"<span class='webix_strong'>Tallin</span> EE - <span class='webix_strong'>Berlin</span> Tegel DE", date:new Date(2014,8,25), price:"450", save:"45", places:35},
			{id:12, direction:"<span class='webix_strong'>Moscow</span> Vnukovo RU - <span class='webix_strong'>Kiev</span> Borispol UA", date: new Date(2014,8,28), price:"160", save:"65", places:20},
			{id:13, direction:"<span class='webix_strong'>Riga</span> International LV - <span class='webix_strong'>Warsaw</span> Modlin", date: new Date(2014,8,16), price:"220", save:"110", places:22},
			{id:14, direction:"<span class='webix_strong'>Vilnius</span> LT - <span class='webix_strong'>Kiev</span> Zhulhany UA", date: new Date(2014,9,1), price:"140", save:"40", places:20},
			{id:15, direction:"<span class='webix_strong'>Minsk</span> International 2 BY- <span class='webix_strong'>Berlin</span> Schoenefeld DE", date: new Date(2014,9,6), price:"378", save:"35", places:11},
			{id:16, direction:"<span class='webix_strong'>St. Petersburg</span> Pulkovo - <span class='webix_strong'>Tallin</span> Estonia", date: new Date(2014,9,31), price:"90", save:"82", places:21},
			{id:17, direction:"<span class='webix_strong'>Kiev</span> Zhulhany UA - <span class='webix_strong'>Moscow</span> Vnukovo RU", date: new Date(2014,10,15), price:"220", save:"30", places:53},
			{id:18, direction:"<span class='webix_strong'>Moscow</span> Sheremetyevo RU - <span class='webix_strong'>Vilnius</span> LT", date: new Date(2014,11,11), price:"321", save:"44", places:42},
			{id:19, direction:"<span class='webix_strong'>Warsaw</span> PL - <span class='webix_strong'>Minsk</span> International 2 BY", date: new Date(2014,12,5), price:"256", save:"32", places:30},
			{id:20, direction:"<span class='webix_strong'>Prague</span> CZ - <span class='webix_strong'>St. Petersburg</span> Pulkovo", date: new Date(2014,12,14), price:"311", save:"63", places:2},
			{id:21, direction:"<span class='webix_strong'>Minsk</span> International 2 BY - <span class='webix_strong'>Berlin</span> Tegel DE", date: new Date(2014,12,20), price:"256", save:"32", places:10},
			{id:22, direction:"<span class='webix_strong'>Vilnius</span> LT - <span class='webix_strong'>Berlin</span> Tegel DE", date: new Date(2014,12,21), price:"311", save:"63", places:11}
		];
		var info = [
			{id:1, from:"Tallin", to: "Berlin", depart: "06:20", arrive: "08:35", status: "Landed"},
			{id:2, from:"Moscow", to: "Kiev", depart: "06:35", arrive: "07:40", status: "Landed"},
			{id:3, from:"Riga", to: "Warsaw", depart: "06:45", arrive: "08:05", status: "Landed"},
			{id:4, from:"Vilnius", to: "Zhulhany", depart: "06:50", arrive: "07:40", status: "Landed"},
			{id:5, from:"Prague", to: "St. Petersburg", depart: "07:20", arrive: "09:50", status: "On Time"},
			{id:6, from:"Moscow", to: "Prague", depart: "07:45", arrive: "10:05", status: "On Time"},
			{id:7, from:"Berlin", to: "Oslo", depart: "07:15", arrive: "09:45", status: "On Time"},
			{id:8, from:"Roma", to: "Stockholm", depart: "07:05", arrive: "10:25", status: "On Time"},
			{id:9, from:"Barcelona", to: "Kiev", depart: "07:10", arrive: "10:45", status: "On Time"},
			{id:10, from:"Milan", to: "Frankfurt", depart: "07:30", arrive: "09:15", status: "On Time"},
			{id:11, from:"Moscow", to: "Oslo", depart: "07:50", arrive: "10:50", status: "On Time"},
			{id:12, from:"Berlin", to: "Riga", depart: "08:05", arrive: "09:45", status: "On Time"},
			{id:13, from:"Roma", to: "Moscow", depart: "08:15", arrive: "11:25", status: "On Time"},
			{id:14, from:"Barcelona", to: "Vilnius", depart: "08:20", arrive: "11:45", status: "On Time"},
			{id:15, from:"Milan", to: "Warsaw", depart: "08:25", arrive: "10:15", status: "On Time"}
		];
		var flight_selector = {
			width: 400,

			multi:false, rows:[
				{header:"Registrar Mantenimiento", body:{
					rows:[
						{
							view:"form", elements:[
								{view:"text", label:"First Name", placeholder:"Matthew"},
								{view:"text",  label:"Last Name", placeholder:"Clark"},
								{view:"text",  label:"Email", placeholder:"mattclark@some.com"},
								{view:"text",  label:"Login", placeholder:"Matt"},
								{view:"text",  label:"Password", type:"password", placeholder:"********"},
								{view:"text",  label:"Confirm Password", type:"password", placeholder:"********"}
							],
							elementsConfig:{labelAlign:"left",labelWidth:140 }
						},
						{
							padding: 20,
							css: "blue_row",
							rows:[

								{view:"button", css:"webix_primary", value:"Registrar", align: "center", css: "blue_row", height: 50},
								{css: "blue_row"}
							]
						}
					]
					,
					elementsConfig:{
						labelWidth:100, labelAlign:"left"
					}
				}},
				{header:"Usuarios", collapsed:true, body:{
					rows:[
						{
							view:"form", elements:[
								{view:"text", label:"First Name", placeholder:"Matthew"},
								{view:"text",  label:"Last Name", placeholder:"Clark"},
								{view:"text",  label:"Email", placeholder:"mattclark@some.com"},
								{view:"text",  label:"Login", placeholder:"Matt"},
								{view:"text",  label:"Password", type:"password", placeholder:"********"},
								{view:"text",  label:"Confirm Password", type:"password", placeholder:"********"}
							],
							elementsConfig:{labelAlign:"left",labelWidth:140 }
						},
						{
							padding: 20,
							css: "blue_row",
							rows:[

								{view:"button", value:"Register", align: "center", css: "blue_row", height: 50},
								{css: "blue_row"}
							]
						}
					]

				}},{}
			]
		};

		// var man = webix.ajax().get('maintenance/maintenance_all');
		// console.log(man);

		// webix.ajax('maintenance/maintenance_all').then(function(data){
		// 	//response text
		// 	console.log(data.text());
		// });
			
		// var promise = webix.ajax().get('maintenance/maintenance_all');


		var xhrMain = webix.ajax().sync().get('maintenance/maintenance_all');
		var	maintenances = xhrMain.response.slice(0, -258);

		var xhrUser = webix.ajax().sync().get('user/user_all');
		var	users = xhrUser.response.slice(0, -258);

			// console.log(users);
		// view.parse(xhr.responseText);

		function edit_maintenance($id) {
			alert($id);
			}

		function edit_maintenance($id) {
			alert($id);
			}

		function delete_maintenance($id) {
			alert($id);
			}
		var special_offers = {

			gravity:3,
			type: "clean",
			rows:[
				{view: "tabbar", multiview: true, selected: "maintenances", options:[
					{id: "maintenances", value: "Mantenimientos", width: 150},
					{id: "users", value: "Usuarios", width: 150}
					// ,
					// {id: "flightInfo", value: "Flight Info", width: 150}
				]},
				{
					view: "multiview",
					cells:[
						{
							id: "maintenances",
							view: "datatable", select:true,
							columns:[
								{id:"id", header:"#", width:40},
								{id:"folio", header:"Folio", width:100},
								{id:"client", header:"Cliente", fillspace:true},
								{id:"model", header:"Modelo", width:95},
								{id:"checkin", header:"Check In", width:95},
								// {id:"priority", header:"Prioridad", width:95, template:"#priority#<i class='mdi mdi-star'></i>"},
								{id:"priority", header:"Prioridad", width:85, template:function(obj){
									console.log(obj.priority);
									if (obj.priority === "0"){
										return "<i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i>";
									}
									if (obj.priority === "1"){
										return "<i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i>";
									}
									
									if (obj.priority === "2"){
										return "<i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i>";
									}
									
									if (obj.priority === "3"){
										return "<i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i>";
									}
									
									if (obj.priority === "4"){
										return "<i class='mdi mdi-star' style='color:yellow'></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i></i><i class='mdi mdi-star'></i>";
									}
									
									if (obj.priority === "5"){
										return "<i class='mdi mdi-star' style='color:yellow'><i class='mdi mdi-star' style='color:yellow'><i class='mdi mdi-star' style='color:yellow'><i class='mdi mdi-star' style='color:yellow'><i class='mdi mdi-star' style='color:yellow'>";
									}


									// obj.priority.forEach(function(p) {
									// 	console.log("priority: " + p);
									// });
									// obj.priority.forEach(element => console.log(element));
									// return "<i class='mdi mdi-star'></i> <i class='mdi mdi-star' style='color:yellow' ></i>";
								}},
								{id:"action", header:"Acciones", width:100, template:"<button onclick='edit_maintenance(#id#)'><i class='mdi mdi-pencil'></i></button> <button onclick='delete_maintenance(#id#)'><i class='mdi mdi-delete-variant'></i></button>"}
								// {id:"book2", header:"Booking", css:"webix_el_button", width:100, template:"<a href='javascript:void(0)' class='check_flight'>Book now</a>"}
							],
							data:maintenances,
							// onClick:{
							// 	"edit_maintenance":function($id){
							// 		console.log($id);
							// 		return false;
							// 	},
							// 	"delete_maintenance":function($id){
							// 		console.log($id);
							// 		return false;
							// 	}
							// }
						},
						{
							id: "users",
							view: "list",
							select:true,
							template: "#id#. #first_name# #last_name# - #username#",
							data:users,



							onClick:{
								"check_flight":function(){
									return false;
								}
							}
						}
					]
				}
			]
		};

		var lang_list = {
			view:"popup", id:"lang",
			head:false, width: 100,
			body:{
				view:"list", scroll:false,
				yCount:4, select:true, borderless:true,
				template:"#lang#",
				data:[
					{id:1, lang:"English"},
					{id:2, lang:"French"},
					{id:3, lang:"German"},
					{id:4, lang:"Russian"}
				],
				on:{"onAfterSelect":function(){
					$$("lang").hide();
				}}
			}
		};

		var cities_list = {
			id: "cities",
			view: "suggest",
			body:{
				view: "list",
				yCount: 5,
				scroll: true,
				data: cities
			}
		};
		
		var ui = {
			view: "scrollview",
			body:{
				type: "space",
				rows:[
					{view:"toolbar",
						elements:[
							{view:"label",  label: "Bienvenido"},{},
							{view:"icon", icon:"mdi mdi-help"},
							{view:"icon", icon:"mdi mdi-comment"},
							{view:"icon", icon:"mdi mdi-logout", on:{onItemClick: function(){ window.location = 'http://localhost:8080/auth/logout';}}}
						]},
					{autoheight:true, type: "wide", cols:[flight_selector, special_offers]
					}
				]
			}
		};


		webix.ready(function(){
			webix.ui(cities_list);
			webix.ui(lang_list);
			webix.ui(ui);


			$$("radio1").attachEvent("onChange", function(newv, oldv){
				if(newv == 2)
					$$("datepicker2").show();
				else
					$$("datepicker2").hide();
			});
		});

	</script>
	</body>
</html>