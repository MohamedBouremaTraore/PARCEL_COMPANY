 /* La table clents contient àla fois l'admnstrateur, le seller et le livreur, mis en evidence par le 
 champ type:[admin,client,livreur]*/
 insert into `clients`(`id`, `username`, `password`, `email`, `type`, `created_at`, `updated_at`)  values(1,"client","client12345","client@gmail.com","client", now(), now());
 insert into `clients`(`id`, `username`, `password`, `email`, `type`, `created_at`, `updated_at`) values(2,"admin","admin12345","admin@gmail.com","admin",now(),now());
 insert into `clients`(`id`, `username`, `password`, `email`, `type`, `created_at`, `updated_at`) values(3,"livreur","livreur12345","livreur@gmail.com","livreur",now(),now());

/* la table colis peut contients des colis d'un client. Il peut se situer à differents étapes 
 [ ramassage, traitement]*/

INSERT INTO `colis`(`id`,  `id_clients`,`reference`, `destinateur`, `telephone`, `ville`, `prix`, `etat`, `produit`,`status`,`commentaire`, `created_at`, `updated_at`) VALUES (1,1,"ref1","dest1",555,"ville1",222,"traitement","prod1","ramassage"," ",now(),now());
 INSERT INTO `colis`(`id`, `id_clients`, `reference`, `destinateur`, `telephone`, `ville`, `prix`, `etat`, `produit`,`status`,`commentaire`, `created_at`, `updated_at`) VALUES (2,1,"ref1","dest1",555,"ville1",222,"traitement","prod1","ramassage"," ",now(),now());
 INSERT INTO `colis`(`id`,  `id_clients`,`reference`, `destinateur`, `telephone`, `ville`, `prix`, `etat`, `produit`,`status`, `commentaire`,`created_at`, `updated_at`) VALUES (3,1,"ref1","dest1",555,"ville1",222,"traitement","prod1","ramassage"," ",now(),now());
 /*  la table transaction permet d'établir une rélation entre un colis et un livreur */

 INSERT INTO `transactons`(`id`, `id_clients`, `id_colis`, `created_at`, `updated_at`) 
 VALUES (1,1,1,now(),now());
  INSERT INTO `transactons`(`id`, `id_clients`, `id_colis`, `created_at`, `updated_at`) 
 VALUES (2,1,2,now(),now());
  INSERT INTO `transactons`(`id`, `id_clients`, `id_colis`, `created_at`, `updated_at`) 
 VALUES (3,1,3,now(),now());

 