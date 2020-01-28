<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li <?php if($sf_request->getParameter('module') == 'dashboard'): ?> class="active" <?php endif;?>><a href="<?php echo url_for('dashboard') ?>"><i class="icon-home4"></i> <span>Tableau de Bord</span></a></li>
								<?php if($sf_user->hasCredential("utilisateursadministration") Or $sf_user->hasCredential("profiladministration")):?>
									<li <?php if($sf_request->getParameter('module') == 'Administration'): ?> class="active" <?php endif;?>>
										<a href="#"><i class="icon-user-check"></i> <span>Administration</span></a>
										<ul>
											<?php if($sf_user->hasCredential("utilisateursadministration")):?>
											<li><a href="<?php echo url_for('Utilisateurs') ?>" id="layout2">Gestion des Utilisateurs</a></li>
										   	<?php endif;?>
											<?php if($sf_user->hasCredential("profiladministration")):?>
											<li><a href="<?php echo url_for('Profil') ?>" id="layout3">Gestion des profils</a></li>
										   	<?php endif;?>
										   	<?php if($sf_user->hasCredential("parametrage")) : ?>
											<li <?php if($sf_request->getParameter('module') == 'Parametrage'): ?> class="active" <?php endif;?>><a href="<?php echo url_for("Parametrage/index"); ?>">Parametrage</a></li>
											<?php endif;?>
										</ul>
									</li>
								<?php endif;?>
								
								<?php if($sf_user->hasCredential("firme")):?>
								<li <?php if($sf_request->getParameter('module') == 'Firme'): ?> class="active" <?php endif;?>><a href="<?php echo url_for('Firme/index')?>"><i class="icon-pushpin"></i> <span>Gestion des firmes</span></a></li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("opportunite")):?>
								<li <?php if($sf_request->getParameter('module') == 'Opportunite'): ?> class="active" <?php endif;?>><a href="<?php echo url_for('Opportunite/index') ?>"><i class="icon-brain"></i><span>Opportunit&eacute;s</span></a></li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("visite_effectuee")):?>
								<li <?php if($sf_request->getParameter('module') == 'visite_effectuee'): ?> class="active" <?php endif;?>><a href="<?php echo url_for('Calendar')?>"><i class="icon-address-book"></i> <span>Gestion des visites</span></a></li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("decouverte")):?>
								<li <?php if($sf_request->getParameter('module') == 'decouverte'): ?> class="active" <?php endif;?>>
									<a href="<?php echo url_for('decouverte/index')?>">
										<i class="icon-eye8"></i> <span>Gestion des Découvertes</span>
									</a>
								</li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("commentaire")):?>
								<li <?php if($sf_request->getParameter('module') == 'commentaire'): ?> class="active" <?php endif;?>>
									<a href="<?php echo url_for('commentaire/index')?>">
										<i class="icon-comment-discussion"></i> <span>Gestion des commentaires</span>
									</a>
								</li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("reclamation")):?>
								<li <?php if($sf_request->getParameter('module') == 'Reclamation'): ?> class="active" <?php endif;?>><a href="<?php echo url_for('Reclamation/index')?>"><i class="icon-wrench3"></i> <span>Gestion des Réclamations</span></a></li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("historique")):?>
								<li <?php if($sf_request->getParameter('module') == 'Historique'): ?> class="active" <?php endif;?>><a href="<?php echo url_for('Historique/index')?>"><i class="icon-history"></i> <span>Historique modification</span></a></li>
								<?php endif;?>
								
								<?php if($sf_user->hasCredential("recouvrement")):?>
								<li <?php if($sf_request->getParameter('module') == 'recouvrement'): ?> class="active" <?php endif;?>>
									<a href="#"><i class="icon-coins"></i> <span>Recouvrement</span></a>
									<ul>
										<li>
											<a href="<?php echo url_for('recouvrement/index')?>">
												<span>Gestion de recouvrement</span>
											</a>
										</li>
										<?php if($sf_user->hasCredential("suiviagentrecouvrement")):?>
										<li>
											<a href="<?php echo url_for('recouvrement/suiviagent')?>">
												<span>Recouvrement par agent</span>
											</a>
										</li>
										<?php endif;?>
										<?php if($sf_user->hasCredential("suiviresultatrecouvrement")):?>	
										<li>
											<a href="<?php echo url_for('recouvrement/suiviresultat')?>">
												<span>Recouvrement par resultat</span>
											</a>
										</li>
										<?php endif;?>
										<li>
											<a href="<?php echo url_for('planning_recouvrement/planning')?>">
												<span>Planning recouvrement</span>
											</a>
										</li>
									</ul>
									
								</li>
								<?php endif;?>
								
								<?php if($sf_user->hasCredential("televente")):?>
								<li <?php if($sf_request->getParameter('module') == 'televente'): ?> class="active" <?php endif;?>>
									<a href="#"><i class="icon-price-tag"></i> <span>T&eacute;l&eacute;vente</span></a>
									<ul>
										<li>
											<a href="<?php echo url_for('televente/index')?>">
												<span>Gestion du portefeuille</span>
											</a>
										</li>
										<li>
											<a href="<?php echo url_for('televente', array("app_jr"=>1))?>">
												<span>Mes appels de la journée</span>
											</a>
										</li>
										<?php if($sf_user->hasCredential("suiviteleventetelevente")):?>
										<li>
											<a href="<?php echo url_for('televente/suivitelevente')?>">
												<span>Suivi televente</span>
											</a>
										</li>
										<?php endif;?>
										<li>
											<a href="<?php echo url_for('planning_televente/planning')?>">
												<span>Planning televente</span>
											</a>
										</li>
									</ul>
									
								</li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("objectif")):?>
								<li <?php if($sf_request->getParameter('module') == 'Objectif'): ?> class="active" <?php endif;?>><a href="<?php echo url_for('Objectif/index')?>"><i class="icon-history"></i> <span>Objectif</span></a></li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("validetracabilite")):?>
									<li <?php if($sf_request->getParameter('action') == 'valide' or $sf_request->getParameter('action')=="validation" ): ?> class="active" <?php endif;?>>
										<a href="#">
											<i class="icon-check"></i> 
											<span>Validations</span>
										</a>
										<ul>
											<li>
												<a href="<?php echo url_for('Tracabilite/valide')?>" id="layout2">
													Validation des modifications
												</a>
											</li>
											<li>
												<a href="<?php echo url_for('Tracabilite/validation') ?>" id="layout2">
													Historique validation
												</a>
											</li>
										</ul>
									</li>
								<?php endif;?>
								<?php if($sf_user->hasCredential("tracabilite")):?>
								<li <?php if($sf_request->getParameter('module') == 'Tracabilite' and ($sf_request->getParameter('action')=="index" or $sf_request->getParameter('action')=="nombreConnexion" or $sf_request->getParameter('action')=="derniereAction")): ?> class="active" <?php endif;?>>
								        <a href="#"><i class="icon-footprint"></i> <span>Traçabilité</span></a>
										<ul>
											<li><a href="<?php echo url_for('Tracabilite/index') ?>" id="layout2">détails des consultations</a></li>
											<li><a href="<?php echo url_for('Tracabilite/nombreConnexion') ?>" id="layout2">Nombre de connexion</a></li>
											<li><a href="<?php echo url_for('Tracabilite/derniereAction') ?>" id="layout2">Dernière action</a></li>
										</ul>
								<?php endif;?>
								<?php if($sf_user->hasCredential("reporting") Or $sf_user->hasCredential("evolutionclientreporting")  Or $sf_user->hasCredential("renouvellementcommandereporting")  Or $sf_user->hasCredential("activitecommercialereporting")  Or $sf_user->hasCredential("suiviremreporting") ):?>
								<li <?php if($sf_request->getParameter('module') == 'Reporting'): ?> class="active" <?php endif;?>>
								        <a href="#"><i class="icon-graph"></i> <span>Reporting</span></a>
										<ul>
											<?php if($sf_user->hasCredential("reporting") ) : ?> <li><a href="<?php echo url_for('Reporting/index') ?>" id="layout2">Reporting par Commercial</a></li><?php endif;?>
											<?php if($sf_user->hasCredential("evolutionclientreporting")): ?> <li><a href="<?php echo url_for('Reporting/evolutionClient') ?>" id="layout2">Reporting par client</a></li><?php endif;?>
											<?php if($sf_user->hasCredential("renouvellementcommandereporting") ) : ?> <li><a href="<?php echo url_for('Reporting/renouvellementCommande') ?>" id="layout2">Suivi Renouvellement commande</a></li><?php endif;?>
											<?php if($sf_user->hasCredential("activitecommercialereporting")) : ?> <li><a href="<?php echo url_for('Reporting/activiteCommerciale') ?>" id="layout2">Suivi Activité</a></li><?php endif;?>
											<?php if($sf_user->hasCredential("suiviremreporting")) : ?> <li><a href="<?php echo url_for('Reporting/suivirem') ?>" id="layout2">Rem Client</a></li><?php endif;?>
										</ul>
								<?php endif;?>
								<!-- /page kits -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->
