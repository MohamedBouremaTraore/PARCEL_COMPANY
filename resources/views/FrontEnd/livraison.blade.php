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
<body class="container">
    <!--------HEADER  -->
    <div class="row" id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{url('/')}}"><h4 style="padding: 0px;margin:0px"> Colis Livreur </h4></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active bg-success" aria-current="page" href="{{url('/commande')}}">Ajouter une demande de livraison</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link bg-success" href="{{url('/livraison')}}" style="left:20px;position:relative">Mes demandes de livraison(0)</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </div>
    <!-------- END HEADER  -->

     <!--------BODY -->
<!--Thirst parties--->
     <div class="row" style="margin: 40px 0px">
        <div class="row" style="margin: 0px 0px 20px 0px"> 
           <div class="col col-md-4" style="margin: 0px 0px 10px 0px">
               <div class="bg-success w-50">
                  <span >Colis pris en charge (0)</span>
               </div>
            </div>

            <div class="col col-md-4 " style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Recu par centre de tri (0)</span>
                </div>
             </div>

             <div class="col col-md-3" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >En acheminement</span>
                </div>
             </div>

             <div class="col col-md-3" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >En livraison</span>
                </div>
             </div>

             <div class="col col-md-3" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Annullée</span>
                </div>
             </div>

             <div class="col col-md-4" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Chargement Destination</span>
                </div>
             </div>

             <div class="col col-md-3" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Demande Retour</span>
                </div>
             </div>

             <div class="col col-md-3" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Retours Envoyés</span>
                </div>
             </div>

             <div class="col col-md-5" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Retours Recu, Centre de tri</span>
                </div>
             </div>

             <div class="col col-md-5" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Retours Recu, Centre de agence</span>
                </div>
             </div>
             <div class="col col-md-3" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Terminés</span>
                </div>
             </div>
             <div class="col col-md-3" style="margin: 0px 0px 10px 0px">
                <div class="bg-success w-50">
                   <span >Tous</span>
                </div>
             </div>
        </div>
        <div class="row">  
     </div>

     <!--Second parties--->

     <div class="row">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
              <div>Afficher <span>10</span> éléments</div>
              <form class="d-flex">
                <div>Rechercher : </div>
                <div>
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </div>
                 </form>
            </div>
          </nav>
     </div>
    

<!--Third parties--->
     <div class="row">
        <table class="table">
            <thead>
              <tr>
                <th scope="col"><i class="fa fa-sort" aria-hidden="true"></i> Code</th>
                <th scope="col"><i class="fa fa-sort" aria-hidden="true"></i> Destinataire</th>
                <th scope="col"><i class="fa fa-sort" aria-hidden="true"></i> Details</th>
                <th scope="col"><i class="fa fa-sort" aria-hidden="true"></i> Etat</th>
                <th scope="col"><i class="fa fa-sort" aria-hidden="true"></i>Remarques<i class="fa fa-sort" aria-hidden="true"></i></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
     </div>
    </div>
    <!--------END BODY  -->

     <!--------FOOTER  -->
     <div class="row">
        <!-- Footer -->
<footer class="bg-primary text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button">
            <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
  
        <!-- Twitter -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
          ><i class="fa fa-twitter"></i
        ></a>
  
        <!-- Instagram -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
          ><i class="fa fa-instagram"></i
        ></a>
  
      </section>
      <!-- Section: Social media -->
  
      <!-- Section: Form -->
      <section class="">
        <form action="">
          <!--Grid row-->
          <div class="row d-flex justify-content-center">
            <!--Grid column-->
            <div class="col-auto">
              <p class="pt-2">
                <strong>Sign up for our newsletter</strong>
              </p>
            </div>
            <!--Grid column-->
  
            <!--Grid column-->
            <div class="col-md-5 col-12">
              <!-- Email input -->
              <div class="form-outline form-white mb-4">
                <input type="email" id="form5Example2" class="form-control" />
                <label class="form-label" for="form5Example2">Email address</label>
              </div>
            </div>
            <!--Grid column-->
  
            <!--Grid column-->
            <div class="col-auto">
              <!-- Submit button -->
              <button type="submit" class="btn btn-outline-light mb-4">
                Subscribe
              </button>
            </div>
            <!--Grid column-->
          </div>
          <!--Grid row-->
        </form>
      </section>
      <!-- Section: Form -->
  
      <!-- Section: Text -->
      <section class="mb-4">
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum
          repellat quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam
          eum harum corrupti dicta, aliquam sequi voluptate quas.
        </p>
      </section>
      <!-- Section: Text -->
  
     
    </div>
    <!-- Grid container -->
  
    <!-- Copyright -->
    <div class="text-center p-3">
      © 2020 Copyright:
      <a class="text-white" href="#">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
    </div>
    <!--------END FOOTER   -->
</body>
</html>