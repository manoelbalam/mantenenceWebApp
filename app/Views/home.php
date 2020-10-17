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


		var xhrMain = webix.ajax().sync().get('maintenance/maintenance_all');
		var	maintenances = xhrMain.response;

		var xhrUser = webix.ajax().sync().get('user/user_all');
		var	users = xhrUser.response;

			// console.log(users);
		// view.parse(xhr.responseText);
		function insertMaintenance(id){
			// webix.message("insertMaintenance" + id);
			// var form = $$("$MaintenanceForm");
			// if (form.validate())
			// 	webix.message("All is correct");
			// else
			// 	webix.message({ type:"error", text:"Form data is invalid" });
					// $$("$MaintenanceForm").validate();
			// your code here
			// "Click on button btn1"
			var maintenance = $$("MaintenanceForm").getValues();
			// JSON.stringify(obj)
			// console.log(maintenance.id);
			if (maintenance.id === "") {
				// console.log('create');
				var uri = 'maintenance/maintenance_add';
				//...
			}

			if (maintenance.id !== "") {
				// console.log('update');
				var uri = 'maintenance/maintenance_update';
				//...
			}

			webix.ajax().post(uri, maintenance).then(function(data){
			// 	//response text
				// var res =data.text());
				var res = JSON.parse(data.text());
				
				webix.message({ type:"Aviso", text:res.message });
				// $$("$maintenanceTable").refresh();

			});
			
		}
		
		function edit_maintenance($id) {
			var xhrMain2 = webix.ajax().sync().get('maintenance/getmaintenance/' + $id);
		    var maintenance = JSON.parse(xhrMain2.responseText);
			$$("MaintenanceForm").setValues({
				id: maintenance.id, 
				folio: maintenance.folio,
				client: maintenance.client,
				model: maintenance.model,
				checkin: maintenance.checkin,
				priority: maintenance.priority
			});
			}

		function delete_maintenance(id) {
			webix.confirm({
				title: "Desechar Mantenimiento",
				text: "Esta apunto de eliminar el registro de mantemiendo actual!",
				type:"confirm-error"
			})
			.then(function(result){
				var xhrDelMani = webix.ajax().sync().get('maintenance/maintenance_delete/'+id);
				var delMani = JSON.parse(xhrDelMani.responseText)
				webix.message({ type:"Aviso", text:delMani.message });
				
			})
		}

		function clearMaintenance(id) {
			webix.confirm({
				title: "Desechar Mantenimiento",
				text: "Esta apunto de descartar los cambios en el formulario de mantemiendo actual!",
				type:"confirm-error"
			})
			.then(function(result){
				$$('MaintenanceForm').clear();
			})
		}

		var flight_selector = {
			width: 400,

			multi:false, rows:[
				{header:"Registrar Mantenimiento", body:{
					rows:[
						{



							view:"form", id:"MaintenanceForm", 
							elementsConfig:{labelAlign:"left",labelWidth:140 },
							elements:[
								{view:"text", name:"id", type:"text"},
								{view:"text", name:"folio", label:"Folio", placeholder:"###", invalidMessage: "Username can not be empty" },
								{view:"text", name:"client", label:"Cliente", placeholder:"Nombre"},
								{view:"text", name:"model", label:"Modelo", placeholder:"Modelo"},
								{view:"text", name:"checkin", label:"Check In", placeholder:"Fecha"},
								{view:"text", name:"priority", label:"Prioridad", type:"number", placeholder:"#"},
							],
							
							rules:{
								"folio":webix.rules.isNotEmpty
							}

						},
						{
							padding: 20,
							css: "blue_row",
							rows:[

								// {view:"button", css:"webix_primary", value:"Registrar", align: "center", css: "blue_row", height: 50, click:insert_maintenance},
								{ margin:5, cols:[
									{ view:"button", value:"Limpiar" , click:clearMaintenance},
									{ view:"button", value:"Guardar" , click:insertMaintenance, css:"webix_primary"}
								]},
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


		
		var special_offers = {

			gravity:3,
			type: "clean",
			rows:[
				{view: "tabbar", multiview: true, selected: "maintenancesTable", options:[
					{id: "maintenancesTable", value: "Mantenimientos", width: 150},
					{id: "users", value: "Usuarios", width: 150}
					// ,
					// {id: "flightInfo", value: "Flight Info", width: 150}
				]},
				{
					view: "multiview",
					cells:[
						{
							id: "maintenancesTable",
							view: "datatable", select:true,
							columns:[
								{id:"id", header:"#", width:40},
								{id:"folio", header:"Folio", width:100},
								{id:"client", header:"Cliente", fillspace:true},
								{id:"model", header:"Modelo", width:95},
								{id:"checkin", header:"Check In", width:95},
								// {id:"priority", header:"Prioridad", width:95, template:"#priority#<i class='mdi mdi-star'></i>"},
								{id:"priority", header:"Prioridad", width:85, template:function(obj){
									// console.log(obj.priority);
									// Mejorar esta funcion si tenemos tiempo
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