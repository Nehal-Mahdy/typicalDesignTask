<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style> 

    body{
        color: rgb(4, 107, 26); 
        /* font-weight: 900; */
    }
    label{
       font-weight: 900;
    }
    option{
        color:  rgb(82, 67, 67);
        font-weight: 600;
    }
    button { 
        padding: 1rem 3rem; 
        background: linear-gradient(-45deg, #c9b2ab, #8ebda0);
        border: 0px; 
        color: rgb(4, 107, 26); 
        font-size: 20px; 
        font-weight: bold;
        position: relative; 
        border-radius: 0.2rem; 
        cursor: pointer; 
    } 

    button::before { 
        content: ''; 
        position: absolute; 
        width: 0rem; 
        height: 0.2rem; 
        background-color: green; 
        left: 0; 
        top: 0; 
        border-radius: 0.2rem; 
    } 

    button:hover::before { 
        width: 8.6rem; 
        transition: all 1s ease-in-out; 
    } 


    button::after { 
        content: ''; 
        position: absolute; 
        width: 0rem; 
        height: 0.2rem; 
        background-color: green; 
        right: 0; 
        bottom: 0; 
        border-radius: 0.2rem; 
    } 

    button:hover::after { 
        width: 8.6rem; 
        transition: all 1s ease-in-out; 
    } 
    nav{
        background: linear-gradient(-45deg,  #8ebda0,#c9b2ab);
    }
    .nav-link{
        color: rgb(4, 107, 26); 

    }
    .navbar-brand{
        font-weight: bold;
        color: rgb(79, 110, 86); 

    }
    </style>
<body>


    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Typical Design</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto text-center mt-5">
        <form action="" class="mt-5" id="form">
          <div class="mb-3">
            <label class="form-label">Categories</label>
            <select class=" selectpicker form-control"  name="cat_list" id="cat_id" title="Selecione uma opçao">
                <option value="null">Select or add category</option>
                @foreach($categories as $category)               
                <x-category-item :category="$category"/>
                @endforeach
            </select>  
          </div>
          <div class="form-outline" data-mdb-input-init>
            <input type="text" id="category" name="category" placeholder="Add Category" class="form-control" />
            <label class="form-label" for="category"></label>
          </div>
          <div>
          <a class="btn btn-danger m-2" style="" id='del'>Delete</a>
        </div>
          <button type="submit" class="" id="createNewCat">Save</button>
        </form>
        
        
            </div>
        </div>
      </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function (){
            var id;
            $("#cat_id").change(function(){
                id= $(this).val();
                console.log(id);
                            
            });

            $("form").on("submit", function() {
               
                event.preventDefault();   
                var category = $(this).find('[name=category]').val();
                console.log(category,id);
                $.ajax({
                       data: {
                       category: category,
                       parent_id: id 
                        },
                      url: "{{ route('categories.store') }}",
                      type: "POST",
                      dataType: 'json',
                      headers: { 
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               },
                        success: function(data) {
                                 console.log("Success:", data);
                                 $("form").trigger("reset");
                                 id=null;
                            $("<option >"+category+"</option>").appendTo("select");  
                            alert("Category successfully Added!");         
                            location.reload();                      
                               },
                        error: function(data) {
                        console.error("Error:", data);
                            }
                           });
                        });                       
                        $('#del').click(function (){
                            console.log(id);
                            var token = $("meta[name='csrf-token']").attr("content");
                            $.ajax(
                                  {
                            url: "categories/"+id,
                            type: 'DELETE',
                                 data: {
                                "id": id,
                                 "_token": token,
                                      },
                                 success: function (){
                                    $("form").trigger("reset");
                                    alert("Category successfully deleted!");                                
                                     console.log("it Works");
                                     location.reload();
                                        }
                                   });
                         })         
     
                      })


    </script>
</body>

</html>



