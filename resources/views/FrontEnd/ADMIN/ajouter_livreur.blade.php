<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Document</title>
    <style>
        #header{
            background-color: blue;
        }
    </style>
</head>
<body class="">

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-primary">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <div class="text-center" style="margin: 0px;padding:0px">
                            <img src="{{asset('PHOTO/logo.jpg')}}" alt="" style="margin: 0px;width:160px">
                        </div>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle px-0 text-white">
                                <i class="fa fa-line-chart" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Statistiques</span>
                            </a>
                        </li>
                    
                        <li>
                            <a href="#" class="text-white nav-link px-0 align-middle">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                             <span class="ms-1 d-none d-sm-inline">Employés</span></a>
                        </li>
                     
                        <li>
                            <a href="#" class=" text-white nav-link px-0 align-middle">
                                <i class="fa fa-archive" aria-hidden="true"></i></i> <span class="ms-1 d-none d-sm-inline">Boutiques simulées</span> </a>
                        </li>
                        <li>
                            <a href="#" class=" text-white nav-link px-0 align-middle">
                                <i class="fa fa-archive" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Colis</span> </a>
                        </li>
                        <li>
                            <a href="#" class=" text-white nav-link px-0 align-middle">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Bons de Ramassage</span> </a>
                        </li>
                        <li>
                            <a href="#" class=" text-white nav-link px-0 align-middle">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Bons de Retous</span> </a>
                        </li>
                        <li>
                            <a href="#" class=" text-white nav-link px-0 align-middle">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i></i> <span class="ms-1 d-none d-sm-inline">Factures</span> </a>
                        </li>
                        <li>
                            <a href="#" class=" text-white nav-link px-0 align-middle">
                                <i class="fa fa-flag-checkered" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Réclamations</span> </a>
                        </li>
                        <li>
                            <a href="#" class=" text-white nav-link px-0 align-middle">
                                <i class="fa fa-headphones" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Contacts et Support</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col">
            <section class="">  
              <div class="row" style="height:80px;">
               <div class="d-flex flex-row-reverse bd-highlight">
                <div class="p-2 bd-highlight" style="z-index: 99">
                    <ul class="list-group">
                        <li class="list-group-item border-0 bg-light text-center" onclick="user()"}>
                           <i class="fa fa-user-circle-o fa-3x" aria-hidden="true" style="color: gray"></i>
                        </li>
                        <li class="list-group-item border-0" id="user" style="visibility:hidden">
                               <ul class="list-group"  style="width: 230px">
                                <li class="list-group-item border-top">
                                        <strong>{{$users[0]->username}}</strong> <br/>
                                        <label>{{$users[0]->email}}</label>  
                                </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/user_detail/'.$users[0]->id)}}"><i class="fa fa-user"></i> Mon profile</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/change_password/'.$users[0]->id)}}"><i class="fa fa-lock"></i> Changer mot de passe</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/liste_client/'.$users[0]->id)}}"><i class="fa fa-users" aria-hidden="true"></i> Liste des clients</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/ajouter_client/'.$users[0]->id)}}"><i class="fa fa-user-times" aria-hidden="true"></i> Ajouter un client</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/liste_livreur/'.$users[0]->id)}}"><i class="fa fa-users" aria-hidden="true"></i> Liste des livreurs</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/ajouter_livreur/'.$users[0]->id)}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Ajouter un livreur</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/')}}"><i class="fa fa-power-off"></i> Déconnexion</a>
                                    </li>
                                </ul>                        
                           
                        </li>
                       </ul>
                </div>
               </div>
            </div>
            </section>

                <section>
                        <div class="row border-3 border-top border-bottom  bg-white">
                          <div class="col col-3 " href="#"><a class="nav-link link-secondary bg-light" href="{{url('/nouveau_colis/'.$users[0]->id)}}"><h5>Ajouter Nouveau Livreur</h5> </a></div>
                </section>

                <section class="#">
                  
                
       

<!--Third parties--->
       
        <section>
            <form action="{{url('add_livreur/'.$users[0]->id)}}">
             <div class="row shadow-lg" style="padding:20px;margin :10px 0px" id="ramassage">
                <div class="row">
                    <a href="{{url('/user_detail_switch/'.$users[0]->id)}}" class="link-dark">
                        <i class="fa fa-window-close" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nom commercial <span style="color: red">*</span></label>
                     <input type="text" class="form-control" id="staticEmail" name="nom_commercial">
                </div>

               <div class="row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Mots de passe <span style="color: red">*</span></label>
                 <input type="text" class="form-control" id="staticEmail" name="password">
               </div>
           
             
               <div class="row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Email <span style="color: red">*</span></label>
                 <input type="email" class="form-control" id="inputPassword" name="email">
              </div>

              <input type="hidden" id="id" name="id" value="{{$users[0]->id}}">
              
            <div class="row">
            <button class="btn btn-primary" style="margin: 15px 0px">
                <span style="color: white">
                    Enregistrer
                </span>
            </button>
               </div>

            </div>
        </form>
            </section>

    </div>
                 </section>

            </div>
        </div>
    </div>
 
    <script src="{{asset('style.js')}}"></script>
</body>
</html>