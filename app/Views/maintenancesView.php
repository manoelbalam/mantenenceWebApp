<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>codeigniter 4 ajax crud with datatables and bootstrap modals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>

  <div class="container">
  

  </center>
    <h3>Mantenimientos</h3>
    <br />
    <button class="btn btn-success" onclick="add_maintenance()"><i class="glyphicon glyphicon-plus"></i> Agregar Mantenimiento</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>ID</th>
                    <th>FOLIO</th>
                    <th>CLIENTE</th>
                    <th>MODELO</th>
                    <th>CHECKIN</th>
                    <th>PRIORIDAD</th>

          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
                <?php foreach($maintenances as $maintenance){?>
                     <tr>
                         <td><?php echo $maintenance->id;?></td>
                         <td><?php echo $maintenance->folio;?></td>
                                 <td><?php echo $maintenance->client;?></td>
                                <td><?php echo $maintenance->model;?></td>
                                <td><?php echo $maintenance->checkin;?></td>
                                <td><?php echo $maintenance->priority;?></td>
                                <td>
                                    <button class="btn btn-warning" onclick="edit_maintenance(<?php echo $maintenance->id;?>)">Edit</button>
                                    <button class="btn btn-danger" onclick="delete_maintenance(<?php echo $maintenance->id;?>)">Delete</button>

                                </td>
                      </tr>
                     <?php }?>

      </tbody>

      <tfoot>
        <tr>
        <th>ID</th>
                    <th>FOLIO</th>
                    <th>CLIENTE</th>
                    <th>MODELO</th>
                    <th>CHECKIN</th>
                    <th>PRIORIDAD</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>

  </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</div>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready( function () {

    
    
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;

    function add_maintenance()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function save()
    {
      
      var uri;
      if(save_method == 'add')
      {
        uri = '/maintenance_add/';
      }
      else
      {
        uri = '/maintenance_update/';
        // url = window.location.href + '/book_update';
      }
    //   console.log($('#form').serialize());
       // ajax adding data to database
          $.ajax({
            url : window.location.href+uri,
            type: 'POST',
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data SAVE');
                console.log(jqXHR);
            }
        });
    }

    function edit_maintenance(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      <?php header('Content-type: application/json'); ?>
      //Ajax Load data from ajax
    //   console.log(window.location.href + '/getmaintenance/' + id);
      $.ajax({
        url : window.location.href + '/getmaintenance/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);

            $('[name="id"]').val(data.id);
            $('[name="folio"]').val(data.folio);
            $('[name="client"]').val(data.client);
            $('[name="model"]').val(data.model);
            $('[name="checkin"]').val(data.checkin);
            $('[name="priority"]').val(data.priority);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR);
            alert('Error get data from ajax');
        }
    });
    }

    function delete_maintenance(id)
    {
      if(confirm('¿Seguro que desea borrar estos datos?'))
      {
          $.ajax({
            url : window.location.href + '/maintenance_delete/'+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {

               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }
  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h3 class="modal-title">Agregar Mantenimiento</h3>
      </div>

      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Folio</label>
              <div class="col-md-9">
                <input name="folio" placeholder="#####" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Cliente</label>
              <div class="col-md-9">
                <input name="client" placeholder="Pepito Perez" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Modelo</label>
              <div class="col-md-9">
                <input name="model" placeholder="??" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Check In</label>
              <div class="col-md-9">
                <input name="checkin" placeholder="Fecha" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Prioridad</label>
              <div class="col-md-9">
                <input name="priority" placeholder="##" class="form-control" type="text">
              </div>
            </div>

            

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  </body>
</html>