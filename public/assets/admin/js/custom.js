// Register
//$(document).ready(() => 
//{

    // $('.btn-register').on('click', () => {
    //     var nama_petugas = $("#nama_petugas").val();
    //     var username = $("#username").val();
    //     var password = $("#password").val();
    //     var token = $("meta[name = 'csrf_token']").attr("content");

    //     if(nama_petugas.length == "")
    //     {
    //         Swal.fire({
    //             type: 'warning',
    //             icon: 'error',
    //             title: 'Error!...',
    //             text: 'Nama Lengkap Wajib Diisi !'
    //         });
    //     }
    //     else if (username.length == "") 
    //     {
    //         Swal.fire({
    //             type: 'warning',
    //             icon: 'error',
    //             title: 'Error!...',
    //             text: 'Username Wajib Diisi !'
    //         });
    //     }
    //     else if (password.length == "") 
    //     {
    //         Swal.fire({
    //             type: 'warning',
    //             icon: 'error',
    //             title: 'Error!...',
    //             text: 'Password Wajib Diisi !'
    //         });
    //     }
    //     else
    //     {
    //         $.ajax({

    //             url: "{{ route('admin.first_account') }}",
    //             type: "POST",
    //             cache: false,
    //             data: {
    //                 "nama_petugas": nama_petugas,
    //                 "username": username,
    //                 "password": password,
    //                 "_token": token
    //             },

    //             success:function(response)
    //             {
    //                 if(response.success)
    //                 {
    //                     Swal.fire({
    //                         type: 'success',
    //                         icon: 'success',
    //                         title: 'Register Berhasil!',
    //                         text: 'Silahkan Login!'
    //                     });
    //                 }
    //                 else
    //                 {
    //                     Swal.fire({
    //                         type: 'error',
    //                         icon: 'error',
    //                         title: 'Register Gagal!',
    //                         text: 'Silahkan Coba Lagi!'
    //                     });
    //                 }

    //                 console.log(response);

    //             },

    //             error:function(response)
    //             {
    //                 Swal.fire({
    //                     type: 'error',
    //                     icon: 'error',
    //                     title: 'Mohon Maaf!',
    //                     text: 'Server Sedang Error!'
    //                 });
    //             }

    //         });
    //     }
    // });
//});