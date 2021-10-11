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
                                        <a href="{{url('/delete_count/'.$users[0]->id)}}"><i class="fa fa-lock"></i> Supprimer mon compte</a>
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
                          <div class="col col-2 " href="#"><a class="nav-link link-secondary " href="{{url('/ramassage/'.$users[0]->id)}}"><h5>Ramassage</h5> </a></div>
                          <div class="col col-3 bg-light" href="#"><a class="nav-link link-secondary active"href="{{url('/liste_ramassage/'.$users[0]->id)}}"><h5>Liste Ramassage (<span class="text-danger">{{$nbre_ramassage}}</span>)</h5></a></div>
                          <div class="col col-2" href="#"><a class="nav-link link-secondary"href="{{url('/livraison/'.$users[0]->id)}}"><h5>Livraison</h5></a></div>
                          <div class="col col-3" href="#"><a class="nav-link link-secondary" href="{{url('/liste_livraison/'.$users[0]->id)}}"><h5>Liste livraison (<span class="text-danger">{{$nbre_livraison}}</span>)</h5></a></div>
                      </div>
                </section>

                <section class="#">
                  
                  <div class="row">
                     <nav class="navbar navbar-light bg-light">
                       <div class="container-fluid">
                        <form class="d-flex">
                            <div class="row">
                                <div class="col col-4">
                                 <button class="btn ">Rechercher</button> 
                                </div>
                                <div class="col col-8">
                                 <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Rechercher avec reference">
                                </div>
                             </div>
                             </form>
                          <div>Afficher <span>10</span> éléments</div>
                        </div>
                      </nav>
                  </div>
    

<!--Third parties--->
     <div class="row">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Editer<i class="fa fa-sort" aria-hidden="true"></i></th>
                <th scope="col">ID Colis<i class="fa fa-sort" aria-hidden="true"></i></th>
                <th scope="col">Destinataire<i class="fa fa-sort" aria-hidden="true"></i> </th>
                <th scope="col">Téléphone<i class="fa fa-sort" aria-hidden="true"></i> </th>
                <th scope="col">Ville<i class="fa fa-sort" aria-hidden="true"></i> </th>
                <th scope="col">Prix<i class="fa fa-sort" aria-hidden="true"></i></th>
                <th scope="col">Date Ajout<i class="fa fa-sort" aria-hidden="true"></i></th>
                <th scope="col">Date Mise a jour<i class="fa fa-sort" aria-hidden="true"></i></th>
                <th scope="col">Etat<i class="fa fa-sort" aria-hidden="true"></i></th>
                <th scope="col">Produit<i class="fa fa-sort" aria-hidden="true"></i></th>
                <th scope="col">Remarque<i class="fa fa-sort" aria-hidden="true"></i></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($colis as $coli)
                <tr>
                    <td><a class="btn btn-primary" href="{{url('/editer/client/'.$users[0]->id.'/'.$coli->id)}}">Editer</a></td>
                    <th scope="row">{{$coli->reference}}</th>
                    <td>{{$coli->destinateur}}</td>
                    <td>{{$coli->telephone}}</td>
                    <td>{{$coli->ville}}</td>
                    <td>{{$coli->prix}}</td>
                    <td>{{$coli->created_at}}</td>
                    <td>{{$coli->updated_at}}</td>
                    <td>{{$coli->etat}}</td>
                    <td>{{$coli->produit}}</td>
                    <td>Commentae</td>
                  </tr>
           
                @endforeach
            </tbody>
          </table>
     </div>
    </div>
                 </section>

            </div>
        </div>
    </div>
 
    <script src="{{asset('style.js')}}"></script>
</body>
</html>