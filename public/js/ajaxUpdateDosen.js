// console.log("oke");

$('body').on('click', '.tampilModalUbah', function () {

    let dosen_id = $(this).data('id');

    //fetch detail post with ajax
    $.ajax({
        url: `/dashboard/dosen/${dosen_id}/edit`,
        method: 'get',
        dataType: 'json',
        
        success:function(response){
            console.log(response);
            //fill data to form
            $('#id').val(response.data.id);
            $('#nidn').val(response.data.nidn);
            $('#nama').val(response.data.nama);
            $('#singkatan').val(response.data.singkatan);
            $('#nomor_telepon').val(response.data.nomor_telepon);
            $('#kuota_bimbingan').val(response.data.kuota_bimbingan);
            $('#keilmuan').val(response.data.keilmuan);


            //open modal
            $('#formModal').modal('show');
        }
    });

});

//  //action update post
//  $('#btnUpdate').click(function(e) {
//     e.preventDefault();

//     //define variable
//     let dosen_id = $('#dosen_id').val();
//     let nidn = $('#nidn').val();
//     let nama = $('#nama').val();
//     let singkatan = $('#singkatan').val();
//     let nomor_telepon = $('#nomor_telepon').val();
//     let kuota_bimbingan = $('#kuota_bimbingan').val();
//     let keilmuan = $('#keilmuan').val(response.data.keilmuan);
//     let token   = $("meta[name='csrf-token']").attr("content");
    
//     //ajax
//     $.ajax({
//         url: `/dashboard/dosen/${dosen_id}`,
//         type: "PUT",
//         cache: false,
//         data: {
//             "dosen_id": dosen_id,
//             "nidn": nidn,
//             "nama": nama,
//             "singkatan": singkatan,
//             "nomor_telepon": nomor_telepon,
//             "kuota_bimbingan": kuota_bimbingan,
//             "keilmuan": keilmuan,
//             "_token": token
//         },
//         success:function(response){

//             //show success message
//             Swal.fire({
//                 type: 'success',
//                 icon: 'success',
//                 title: `${response.message}`,
//                 showConfirmButton: false,
//                 timer: 3000
//             });

//             //data post
//             let post = `
//                 <tr id="index_${response.data.id}">
//                     <td>${response.data.title}</td>
//                     <td>${response.data.content}</td>
//                     <td class="text-center">
//                         <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
//                         <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
//                     </td>
//                 </tr>
//             `;
            
//             //append to post data
//             $(`#index_${response.data.id}`).replaceWith(post);

//             //close modal
//             $('#modal-edit').modal('hide');
            

//         },
//         error:function(error){
            
//             if(error.responseJSON.title[0]) {

//                 //show alert
//                 $('#alert-title-edit').removeClass('d-none');
//                 $('#alert-title-edit').addClass('d-block');

//                 //add message to alert
//                 $('#alert-title-edit').html(error.responseJSON.title[0]);
//             } 

//             if(error.responseJSON.content[0]) {

//                 //show alert
//                 $('#alert-content-edit').removeClass('d-none');
//                 $('#alert-content-edit').addClass('d-block');

//                 //add message to alert
//                 $('#alert-content-edit').html(error.responseJSON.content[0]);
//             } 

//         }

//     });

// });

