
drop view tts_firmes;

CREATE VIEW `tts_firmes` AS 
select f.*,s.status,v.ville, f.zone_geo as code_zone, rs_comp as firme from BD_EDICOM.firmes f 
                left outer join BD_EDICOM.villes v on v.code=f.code_ville 
                left outer join BD_EDICOM.statuts s on s.code=f.code_statut ;



drop view tts_firme_contact;
CREATE VIEW `tts_firme_contact` AS              
select p.code_personne as code_contact, d.code_firme , p.nom, p.prenom from
BD_EDICOM.personne p inner join BD_EDICOM.lien_dirigeant d on d.code_personne = p.code_personne;


