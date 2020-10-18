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
		var maintenances = webix.ajax().sync().get('maintenance/maintenance_all').response;
		var users = webix.ajax().sync().get('user/user_all').response;

		function renderStars(val) {
			var yellow = parseInt(val);
			switch (yellow) {
				case 0:
					return "<i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i>";
					break;
				case 1:
					return "<i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i>";
					break;
				case 2:
					return "<i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i>";
					break;
				case 3:
					return "<i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star'></i><i class='mdi mdi-star'></i>";
					break;
				case 4:
					return "<i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star'></i>";
					break;
				case 5:
					return "<i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i><i class='mdi mdi-star' style='color:yellow' ></i>";
					break;
				default:
					return "Value Not Found!";
			}
		}

		function insertUser(id){
			var user = $$("UserForm").getValues();
			webix.ajax().post('user/user_add', user).then(function(data){
				var res = JSON.parse(data.text());
				webix.message({ type:"Aviso", text:res.message });
				$$('UserForm').clear();
				$$("usersTable").clearAll();
				$$("usersTable").load(function(){
					return webix.ajax().sync().get('user/user_all').response;
				});
				
			});
		}
		
		function insertMaintenance(id){
			var maintenance = $$("MaintenanceForm").getValues();
			if (maintenance.id === "") {
				var uri = 'maintenance/maintenance_add';
			}
			if (maintenance.id !== "") {
				var uri = 'maintenance/maintenance_update';
			}

			webix.ajax().post(uri, maintenance).then(function(data){
				var res = JSON.parse(data.text());
				webix.message({ type:"Aviso", text:res.message });
				$$('MaintenanceForm').clear();
				reloadMaintenancesTable();
			});
			
		}
		
		function edit_maintenance($id) {
			var maintenance = JSON.parse(webix.ajax().sync().get('maintenance/maintenance_get/' + $id).responseText);
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
				var delMani = JSON.parse(webix.ajax().sync().get('maintenance/maintenance_delete/'+id).responseText);
				webix.message({ type:"Aviso", text:delMani.message });
				reloadMaintenancesTable();
			})
		}

		function reloadMaintenancesTable(){
			$$("maintenancesTable").clearAll();
			$$("maintenancesTable").load(function(){
				return webix.ajax().sync().get('maintenance/maintenance_all').response;
			});
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

		var form_board = {
			width: 400,
			multi:false, rows:[
				{header:"Mantenimiento", body:{
					rows:[
						{
							view:"form", id:"MaintenanceForm", 
							elementsConfig:{labelAlign:"left",labelWidth:140 },
							elements:[
								{view:"text", name:"id", hidden:true},
								{view:"text", name:"folio", label:"Folio", placeholder:"###", invalidMessage: "Username can not be empty" },
								{view:"text", name:"client", label:"Cliente", placeholder:"Nombre"},
								{view:"text", name:"model", label:"Modelo", placeholder:"Modelo"},
								{view:"datepicker", name:"checkin", label:"Check In", value:new Date(), format:"%d  %M %Y"},
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
								{ margin:5, cols:[
									{ view:"button", value:"Limpiar" , click:clearMaintenance},
									{ view:"button", value:"Guardar" , click:insertMaintenance, css:"webix_primary"}
								]}
								
							]
						}
					]
					,
					elementsConfig:{
						labelWidth:100, labelAlign:"left"
					}
				}},
				{header:"Usuario", collapsed:true, body:{
					rows:[
						{
							view:"form", id:"UserForm", elements:[
								{view:"text", name:"first_name", label:"Nombre", placeholder:"Nombre"},
								{view:"text", name:"last_name",  label:"Apellido", placeholder:"Apellido"},
								{view:"text", name:"username",  label:"Usuario", placeholder:"Usuario"},
								{view:"text", name:"email",  label:"Email", placeholder:"email@email.com"},
								{view:"text", name:"password",  label:"Password", type:"password", placeholder:"******"}
							],
							elementsConfig:{labelAlign:"left",labelWidth:140 }
						},
						{
							padding: 20,
							css: "blue_row",
							rows:[

								{view:"button", value:"Guardar", click:insertUser, align: "center", css: "blue_row", height: 50},
								{css: "blue_row"}
							]
						}
					]

				}},{}
			]
		};

		var main_board = {

			gravity:3,
			type: "clean",
			rows:[
				{view: "tabbar", multiview: true, selected: "maintenancesTable", options:[
					{id: "maintenancesTable", value: "Mantenimientos", width: 150},
					{id: "usersTable", value: "Usuarios", width: 150}
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
								{id:"priority", header:"Prioridad", width:85, template:function(obj){
									return renderStars(obj.priority);
								}},
								{id:"action", header:"Acciones", width:100, template:"<button onclick='edit_maintenance(#id#)'><i class='mdi mdi-pencil'></i></button> <button onclick='delete_maintenance(#id#)'><i class='mdi mdi-delete-variant'></i></button>"}
							],
							data:maintenances,
						},
						{
							id: "usersTable",
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
		
		var ui = {
			view: "scrollview",
			body:{
				type: "space",
				rows:[
					{view:"toolbar",
						elements:[
							{view:"label",  label: "Bienvenido"},{},
							{view:"icon", icon:"mdi mdi-logout", on:{onItemClick: function(){ window.location = 'http://localhost:8080/auth/logout';}}}
						]},
					{autoheight:true, type: "wide", cols:[form_board, main_board]
					}
				]
			}
		};
		webix.ready(function(){
			webix.ui(ui);
		});

	</script>
	</body>
</html>