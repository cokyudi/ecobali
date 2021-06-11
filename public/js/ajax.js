
$(document).ready(function () {

    get_district_data()
    
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    //Get all district
    function get_district_data() {
        
        $.ajax({
            url: root_url,
            type:'GET',
            data: { }
        }).done(function(data){
            table_data_row(data.data)
        });
    }
    
    //district table row
    function table_data_row(data) {
    
        var	rows = '';
        
        $.each( data, function( key, value ) {
            
            rows = rows + '<tr>';
                rows = rows + '<td>'+value.district_name+'</td>';
                rows = rows + '<td>'+value.province_name+'</td>';
                rows = rows + '<td data-id="'+value.id+'">';
                rows = rows + '<a class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="editDistrict" data-id="'+value.id+'" data-toggle="modal" data-target="#modal-id">Edit</a> ';
                rows = rows + '<a class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="deleteDistrict" data-id="'+value.id+'" >Delete</a> ';
                rows = rows + '</td>';
            rows = rows + '</tr>';
        });
    
        $("tbody").html(rows);
    }
    
    //Insert district data
    $("body").on("click","#createNewDistrict",function(e){
        e.preventDefault;
        $('#userCrudModal').html("Create District");
        $('#submit').val("create");
        $('#modal-id').modal('show');
        $('#district_id').val('');
        $('#districtData').trigger("reset");
    });
    
    //Save data into database
    $('body').on('click', '#submit', function (event) {
        event.preventDefault()
        
        var id = $("#district_id").val();
        var district_name = $("#district_name").val();
        var province_name = $("#province_name").val();

        if ($('#submit').val() == "create")  {
            var created_by = "Deva Dwi A";
            var created_datetime = new Date().toISOString().slice(0, 19).replace('T', ' ');
            var last_modified_by = null;
            var last_modified_datetime = null;
        } else {
            var created_by = $("#created_by").val();
            var created_datetime = $("#created_datetime").val();
            var last_modified_by = null;
            var last_modified_datetime = null;
        }
        
       
        $.ajax({
          url: store,
          type: "POST",
          data: {
            id: id,
            district_name: district_name,
            province_name: province_name,
            created_by: created_by,
            created_datetime: created_datetime,
            last_modified_by: last_modified_by,
            last_modified_datetime: last_modified_datetime
          },
          dataType: 'json',
          success: function (data) {
              
              $('#districtData').trigger("reset");
              $('#modal-id').modal('hide');
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Success',
                showConfirmButton: false,
                timer: 1500
              })
              get_district_data()
          },
          error: function (data) {
              console.log('Error......');
          }
      });
    });
    
    //Edit modal window
    $('body').on('click', '#editDistrict', function (event) {
    
        event.preventDefault();
        var id = $(this).data('id');
       
        $.get(store+'/'+ id+'/edit', function (data) {
            $('#submit').val("edit");
            $('#userCrudModal').html("Edit District");
            $('#modal-id').modal('show');

            $('#district_id').val(data.data.id);
            $('#district_name').val(data.data.district_name);
            $('#province_name').val(data.data.province_name);
            $('#created_by').val(data.data.created_by);
            $('#created_datetime').val(data.data.created_datetime);
            $('#last_modified_by').val(data.data.last_modified_by);
            $('#last_modified_datetime').val(data.data.last_modified_datetime);
         })
    });
    
     //deleteDistrict
     $('body').on('click', '#deleteDistrict', function (event) {
        if(!confirm("Do you really want to do this?")) {
           return false;
         }
    
         event.preventDefault();
        var id = $(this).attr('data-id');
     
        $.ajax(
            {
              url: store+'/'+id,
              type: 'DELETE',
              data: {
                    id: id
            },
            success: function (response){
              
                Swal.fire(
                  'Remind!',
                  'District deleted successfully!',
                  'success'
                )
                get_district_data()
            }
         });
          return false;
       });
    
    }); 