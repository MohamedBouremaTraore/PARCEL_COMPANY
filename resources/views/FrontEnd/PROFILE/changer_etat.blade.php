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
         
                <section>

                 <form action="{{url('/handle_changer_etat')}}" class="row shadow-lg" style="padding:20px;margin:20px" id="ramassage">
                    <div class="row">
                        <a href="{{url('/user_detail_switch/'.$users[0]->id)}}" class="link-dark">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </a>
                    </div>

                   <div class="row" style="padding: 10px 10px;">
                    <select class="form-select" aria-label="Default select example" name="etat">
                        <option value="{{$colis[0]->etat}}">{{$colis[0]->etat}}</option>
                        <option value="Colis pris en charge">Colis pris en charge</option>
                        <option value="Recu par Centre de tri">Recu par Centre de tri</option>
                        <option value="Changement Destinataire">Changement Destinataire</option>
                        <option value="Retour Envoyé">Retour Envoyé</option>
                        <option value="Demande Retour">Demande Retour</option>
                        <option value="Terminées">Terminées</option>
                      </select>
                   </div>

                   <input type="hidden" id="id" name="id" value="{{$users[0]->id}}">
                   <input type="hidden" id="id" name="id_colis" value="{{$id_colis}}">

                 <div class="row" style="padding: 20px 10px;">
                    <button  class="btn btn-primary" style="width:200px">
                        <span style="color: white">
                             Sauvegarder
                        </span>
                    </button>
                </div>
               

            </form>
                </section>

            </div>
        </div>
    </div>
 

<!----------------------------------------------------->


    <script src="{{asset('style.js')}}"></script>
</body>
</html>