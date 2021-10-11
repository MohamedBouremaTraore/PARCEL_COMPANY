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
                          <div class="col col-2 " href="#"><a class="nav-link link-secondary active" href="{{url('/ramassage/'.$users[0]->id)}}"><h5>Ramassage</h5> </a></div>
                          <div class="col col-3" href="#"><a class="nav-link link-secondary"href="{{url('/liste_ramassage/'.$users[0]->id)}}"><h5>Liste Ramassage (<span class="text-danger">{{$nbre_ramassage}}</span>)</h5></a></div>
                          <div class="col col-2 bg-light" href="#"><a class="nav-link link-secondary"href="{{url('/livraison/'.$users[0]->id)}}"><h5>Livraison</h5></a></div>
                          <div class="col col-3" href="#"><a class="nav-link link-secondary"href="{{url('/liste_livraison/'.$users[0]->id)}}"><h5>Liste livraison (<span class="text-danger">{{$nbre_livraison}}</span>)</h5></a></div>
                       </div>
                </section>


                <section>
                    <div class="row " style="margin: 0px;padding:0px">
                        @if($status=="vide")
                        <div class="alert alert-danger " role="alert">
                          {{$message}}
                        </div>
                        @elseif($status=="modifier")
                        <div class="alert alert-success " role="alert">
                          {{$message}}
                        </div>
                        @endif
                      </div>
                      
                    <div class="row">
                        <div style="margin:/* 5px 10px*/;">
                            <button class="btn btn-primary" onclick="addRamassage()">
                                <span style="color: white">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Nouveau</button>
                                </span> 
                        </div>
                    </div>
                     <form action="{{url('/add_livraison')}}">
                     <div class="row shadow-lg" style="margin: 0px;padding:0px;visibility:hidden;padding:10px 0px;margin :10px 0px" id="ramassage">
    
                       <div class="col col-6">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Reference <span style="color:red">*</span></label>
                         <input type="text" class="form-control" id="staticEmail" name="reference">
                       </div>
    
                       <div class="col col-6">
                        <label for="staticEmail" class="col col-form-label">Destinataire <span style="color:red">*</span></label>
                         <input type="text" class="form-control" id="staticEmail" name="destinataire">
                       </div>
                   
                     
                       <div class="col col-6">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Téléphone <span style="color:red">*</span></label>
                         <input type="number" class="form-control" id="inputPassword" name="telephone">
                      </div>
    
                      <div class="col col-6">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Ville <span style="color:red">*</span></label>
                        <select class="form-select" aria-label="Default select example" name="ville">
    
                            <option value="Agadir">Choisissez une ville</option>
                            <option value="Agadir">Agadir</option>
                                                                                          <option value="Agourai">Agourai</option>
                                                                                          <option value="Aguelmouss">Aguelmouss</option>
                                                                                          <option value="Ain attig">Ain attig</option>
                                                                                          <option value="Ain el aouda">Ain el aouda</option>
                                                                                          <option value="Ain harrouda">Ain harrouda</option>
                                                                                          <option value="Ain leuh">Ain leuh</option>
                                                                                          <option value="Ain tekki">Ain tekki</option>
                                                                                          <option value="Ait amira">Ait amira</option>
                                                                                          <option value="Aït baha">Aït baha</option>
                                                                                          <option value="Ait ishaq">Ait ishaq</option>
                                                                                          <option value="Ait melloul">Ait melloul</option>
                                                                                          <option value="Ait ourir">Ait ourir</option>
                                                                                          <option value="Al hoceima">Al hoceima</option>
                                                                                          <option value="Al-aroui">Al-aroui</option>
                                                                                          <option value="Anza">Anza</option>
                                                                                          <option value="Asilah">Asilah</option>
                                                                                          <option value="Azemmour">Azemmour</option>
                                                                                          <option value="Azilal">Azilal</option>
                                                                                          <option value="Azrou">Azrou</option>
                                                                                          <option value="Bejaad">Bejaad</option>
                                                                                          <option value="Belfaa">Belfaa</option>
                                                                                          <option value="Ben guerir">Ben guerir</option>
                                                                                          <option value="Beni ensar">Beni ensar</option>
                                                                                          <option value="Beni mellal">Beni mellal</option>
                                                                                          <option value="Benslimane">Benslimane</option>
                                                                                          <option value="Berrechid">Berrechid</option>
                                                                                          <option value="Biougra">Biougra</option>
                                                                                          <option value="Boufakrane">Boufakrane</option>
                                                                                          <option value="Boujdour">Boujdour</option>
                                                                                          <option value="Boujniba">Boujniba</option>
                                                                                          <option value="Bouskoura">Bouskoura</option>
                                                                                          <option value="Bouznika">Bouznika</option>
                                                                                          <option value="Cabo negro">Cabo negro</option>
                                                                                          <option value="Casablanca">Casablanca</option>
                                                                                          <option value="Chemmaia">Chemmaia</option>
                                                                                          <option value="Dakhla">Dakhla</option>
                                                                                          <option value="Dar bouazza">Dar bouazza</option>
                                                                                          <option value="Dcheira el jihadia">Dcheira el jihadia</option>
                                                                                          <option value="Deroua">Deroua</option>
                                                                                          <option value="El arjate">El arjate</option>
                                                                                          <option value="El haj kaddour">El haj kaddour</option>
                                                                                          <option value="El hajeb">El hajeb</option>
                                                                                          <option value="El harhoura">El harhoura</option>
                                                                                          <option value="El jadida">El jadida</option>
                                                                                          <option value="El kebab">El kebab</option>
                                                                                          <option value="El kelaa des sraghna">El kelaa des sraghna</option>
                                                                                          <option value="El ksiba">El ksiba</option>
                                                                                          <option value="El mansouria">El mansouria</option>
                                                                                          <option value="Essaouira ( non disponible )">Essaouira ( non disponible )</option>
                                                                                          <option value="Fes">Fes</option>
                                                                                          <option value="Fnideq">Fnideq</option>
                                                                                          <option value="Fquih ben salah">Fquih ben salah</option>
                                                                                          <option value="Guelmim">Guelmim</option>
                                                                                          <option value="Guercif">Guercif</option>
                                                                                          <option value="Ifrane">Ifrane</option>
                                                                                          <option value="Imouzzer kandar">Imouzzer kandar</option>
                                                                                          <option value="Imzouren">Imzouren</option>
                                                                                          <option value="Inezgane">Inezgane</option>
                                                                                          <option value="Jamaat shaim">Jamaat shaim</option>
                                                                                          <option value="Jorf el melha">Jorf el melha</option>
                                                                                          <option value="Kasba tadla">Kasba tadla</option>
                                                                                          <option value="Kehf nsour">Kehf nsour</option>
                                                                                          <option value="Kenitra">Kenitra</option>
                                                                                          <option value="Khemisset">Khemisset</option>
                                                                                          <option value="Khenichet">Khenichet</option>
                                                                                          <option value="Khenifra">Khenifra</option>
                                                                                          <option value="Khouribga">Khouribga</option>
                                                                                          <option value="Ksar el-kébir">Ksar el-kébir</option>
                                                                                          <option value="Laayoune">Laayoune</option>
                                                                                          <option value="Lâayoune el marsa">Lâayoune el marsa</option>
                                                                                          <option value="Larache">Larache</option>
                                                                                          <option value="Lehri">Lehri</option>
                                                                                          <option value="Leqliaa">Leqliaa</option>
                                                                                          <option value="Loudaya">Loudaya</option>
                                                                                          <option value="Louizia">Louizia</option>
                                                                                          <option value="Marrakech">Marrakech</option>
                                                                                          <option value="Martil">Martil</option>
                                                                                          <option value="Mdiq">Mdiq</option>
                                                                                          <option value="Mechra bel ksiri">Mechra bel ksiri</option>
                                                                                          <option value="Mediouna">Mediouna</option>
                                                                                          <option value="Mehdia">Mehdia</option>
                                                                                          <option value="Meknes">Meknes</option>
                                                                                          <option value="Mohammedia">Mohammedia</option>
                                                                                          <option value="Moulay abdellah">Moulay abdellah</option>
                                                                                          <option value="Moulay bouselham">Moulay bouselham</option>
                                                                                          <option value="Moulay yacoub">Moulay yacoub</option>
                                                                                          <option value="Mrirt">Mrirt</option>
                                                                                          <option value="Nador">Nador</option>
                                                                                          <option value="Nouaceur">Nouaceur</option>
                                                                                          <option value="Oualidia  ( non disponible )">Oualidia  ( non disponible )</option>
                                                                                          <option value="Ouarzazate">Ouarzazate</option>
                                                                                          <option value="Ouazzane">Ouazzane</option>
                                                                                          <option value="Oued amlil">Oued amlil</option>
                                                                                          <option value="Oued zem">Oued zem</option>
                                                                                          <option value="Oujda">Oujda</option>
                                                                                          <option value="Oulad teima">Oulad teima</option>
                                                                                          <option value="Ouled mbarek">Ouled mbarek</option>
                                                                                          <option value="Rabat">Rabat</option>
                                                                                          <option value="Sabaa aiyoun">Sabaa aiyoun</option>
                                                                                          <option value="Safi">Safi</option>
                                                                                          <option value="Sala al jadida">Sala al jadida</option>
                                                                                          <option value="Sale">Sale</option>
                                                                                          <option value="Sebt gzoula">Sebt gzoula</option>
                                                                                          <option value="Sefrou">Sefrou</option>
                                                                                          <option value="Selouane">Selouane</option>
                                                                                          <option value="Settat">Settat</option>
                                                                                          <option value="Sidi addi">Sidi addi</option>
                                                                                          <option value="Sidi bibi">Sidi bibi</option>
                                                                                          <option value="Sidi bouknadel">Sidi bouknadel</option>
                                                                                          <option value="Sidi bouzid">Sidi bouzid</option>
                                                                                          <option value="Sidi harazem">Sidi harazem</option>
                                                                                          <option value="Sidi kacem">Sidi kacem</option>
                                                                                          <option value="Sidi slimane">Sidi slimane</option>
                                                                                          <option value="Sidi taibi">Sidi taibi</option>
                                                                                          <option value="Sidi yahia zaers">Sidi yahia zaers</option>
                                                                                          <option value="Sidi yahya el gharb">Sidi yahya el gharb</option>
                                                                                          <option value="Skhirate">Skhirate</option>
                                                                                          <option value="Souk el arbaa du rharb">Souk el arbaa du rharb</option>
                                                                                          <option value="Souk sebt">Souk sebt</option>
                                                                                          <option value="Tahla">Tahla</option>
                                                                                          <option value="Tamansourt">Tamansourt</option>
                                                                                          <option value="Tamesna">Tamesna</option>
                                                                                          <option value="Tanger">Tanger</option>
                                                                                          <option value="Taroudant">Taroudant</option>
                                                                                          <option value="Taza">Taza</option>
                                                                                          <option value="Temara">Temara</option>
                                                                                          <option value="Tetouan">Tetouan</option>
                                                                                          <option value="Tiflet">Tiflet</option>
                                                                                          <option value="Tighessaline">Tighessaline</option>
                                                                                          <option value="Tit mellil">Tit mellil</option>
                                                                                          <option value="Tiznit">Tiznit</option>
                                                                                          <option value="Ville errahma">Ville errahma</option>
                                                                                          <option value="Youssoufia">Youssoufia</option>
                                                                                          <option value="Zagora">Zagora</option>
                                                                                          <option value="Zaouiat cheikh">Zaouiat cheikh</option>
                                                                                          <option value="Zeghanghane">Zeghanghane</option>
                          </select>
                      </div>
    
                      <div class="col col-6">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Prix <span style="color:red">*</span></label>
                         <input type="number" class="form-control" id="inputPassword" name="prix">
                      </div>
    
                      <div class="col col-12">
                        <label for="inputPassword" class="col-12 col-form-label">Produit (si plusieurs separer les avec une " , ") <span style="color:red">*</span></label>
                         <input type="text" class="form-control" id="inputPassword" name="produit">
                      </div>
    
                      <div class="col col-12">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Note <span style="color:red">*</span></label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"name="note"></textarea>
                            <label for="floatingTextarea"></label>
                          </div>
                      </div>
    
                      <div class="col col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="changer" id="flexCheckDefault" name="options_changer">
                            <label class="form-check-label" for="flexCheckDefault">
                                Change (S'il y a un colis a retourné)
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="rembourser" id="flexCheckChecked" name="options_rembourser">
                            <label class="form-check-label" for="flexCheckChecked">
                                Remboursement (NB: les frais sont les même de livraison)
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="ouvrir" id="flexCheckChecked" checked name="options_ouvrir">
                            <label class="form-check-label" for="flexCheckChecked">
                                Permettre l'ouverture de colis par le client
                            </label>
                          </div>
                      </div>
                      <input type="hidden" id="id" name="id" value="{{$users[0]->id}}">
                      <div class="col col-6">
                    <button class="btn btn-primary" onclick="">
                        <span style="color: white">
                             Enregistrer
                        </span>
                    </button>
                       </div>
    
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