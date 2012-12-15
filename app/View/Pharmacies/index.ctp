<script src="https://maps.googleapis.com/maps/api/js?sensor=false&language=fr"></script>
<script type="text/javascript">
	$(function(){
		var latlng = new google.maps.LatLng(14.492835,-14.611816);
		var map = new google.maps.Map(document.getElementById('carte'),{
			zoom : 7,
			center: latlng, 
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var direction = new google.maps.DirectionsRenderer({
		    map   : map,
		    panel : tab2 //le panel ou sera les info d'itinéraire
		});

		var positions = [];
		var iterateur = 0;
		<?php foreach ($pharmacies as $pharma) : $pharma = $pharma['Pharmacie'];?>
			<?php 
				if ($pharma['type'] == "Pharmacie") {
					$image = '/GeoPharma/app/webroot/img/pharmacie.png';
				} elseif ($pharma['type'] == "Centre de santé") {
					$image = '/GeoPharma/app/webroot/img/csante.png';
				} else{
					$image = '/GeoPharma/app/webroot/img/hosto.png';
				} 
			?>
			positions.push({
				lat : <?php echo $pharma['lat']; ?>,
				lng : <?php echo $pharma['lng']; ?>,
				nom : '<?php echo $pharma['nom']; ?>',
				image : '<?php echo $image; ?>'
			});
		<?php endforeach; ?>

		for (var i = 0; i < positions.length; i++) {
			addMarker();
		}

		function addMarker(){
			var marker = new google.maps.Marker({
				position : new google.maps.LatLng(positions[iterateur].lat,positions[iterateur].lng),
				map : map,
				title : positions[iterateur].nom,
				draggable : false,
				clickable : true,
				icon : positions[iterateur].image
			});
			google.maps.event.addListener(marker,'click',function(){
				setPosition(marker);
			});
			iterateur++;
		}

		var marker = new google.maps.Marker({
			position : latlng,
			map : map,
			title : 'Sénégal',
			draggable : false
		});

		var geocoder = new google.maps.Geocoder();

		$('#rechercheOfficine').keypress(function (e) {
				// alert(e.keyCode);
				/*
				* Géner une liste auto complétion qui retour les lat lng
				* Lancer une requete ajax au controller pour récuper les coordonnées 
				*/
				latlng1 = new google.maps.LatLng(14.751523971557617,-17.45958709716797);
				if(e.keyCode==13){

					var request = {
						location : latlng1, // 
						region : 'SN'
						//address : $(this).val()
					}
					geocoder.geocode(request,function(results,status){
							if (status == google.maps.GeocoderStatus.OK) {
								var pos = results[0].geometry.location;
							
								map.setCenter(pos);
								map.setZoom(15);
								marker.setPosition(pos);
								setPosition(marker);
							}else{
								alert("Le lieu n'est n'existe pas dans la base de donnée, veuillez le créer SVP");
							}
					});
					return false;
				}
		});

		$("select").change(function () {
          	$("select option:selected").each(function () {
          		var request = {
					address : $(this).text()
				}
				var options = {
				    backgroundColor: '#ffffff'
				}

				geocoder.geocode(request,function(results,status){
					//alert(status);
					if (status == google.maps.GeocoderStatus.OK) {
						var pos = results[0].geometry.location;
						map.setCenter(pos);
						map.setZoom(12);
						//map.setOptions(options);
						marker.setPosition(pos);
						//setPosition(marker);
					}
				});
            });
        });

		$('#calculer').click(function(){
			var origin = $('#DistanceOrigine');
			var destination = $('#DistanceDestination');
			var latOrigine = $('#DistanceLatOrigine');
			var lngOrigine = $('#DistanceLngOrigine');
			var latDestination = $('#DistanceLatDestination');
			var lngDestination = $('#DistanceLngDestination');
			if( origin.val() =="" && destination.val() == ""){
				alert('Veuillez renseigner l\'origine et la destination');
			}else{
				var latlngOrigine = new google.maps.LatLng(latOrigine.val(),lngOrigine.val());
				var latlngDestionation = new google.maps.LatLng(latDestination.val(),lngDestination.val());
				calculate(latlngOrigine,latlngDestionation,direction);
			}
			return false;
		});

		/* gestion des onglets */
        $(".tab_content").hide(); 
		//$("ul.tabs li:first").addClass("active").show(); 
		//$(".tab_content:first").show(); 
		
		$("ul.tabs li").click(function() {

			$("ul.tabs li").removeClass("active"); 
			$(this).addClass("active"); 
			$(".tab_content").hide(); 

			var activeTab = $(this).find("a").attr("href"); 
			$(activeTab).fadeIn();
			return false;
		});

	});
	function calculate(origin,destination,direction){
	    origin     	= origin; // Le point départ
	    destination = destination; // Le point d'arrivé
	    direction = direction
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Type de transport
        }
        var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
        directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
        	alert(status);
            if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
            }
        });
	}
	function setPosition (marker) {
		var pos = marker.getPosition();
		var nom = marker.getTitle();
		$('#lat').text(pos.lat());
		$('#lng').text(pos.lng());
		$('#lieu').text(nom);

		// initialisation des positions pour le calcul de distance
		if($('#DistanceOrigine').val() ==''){
			//origine
			$('#DistanceOrigine').val(nom);
			$('#DistanceLatOrigine').val(pos.lat());
			$('#DistanceLngOrigine').val(pos.lng());
			//destivation
			$('#DistanceDestination').val();
			$('#DistanceLatDestination').val();
			$('#DistanceLngDestination').val();
		}else if($('#DistanceOrigine').val() !=''){
			$('#DistanceDestination').val(nom);
			$('#DistanceLatDestination').val(pos.lat());
			$('#DistanceLngDestination').val(pos.lng());
		}
	}
</script>

<div id="session">
	<img src="../images/icon.png" alt=""><span><?php echo "Prince"; ?></span>
	<div id="form">
		<?php
			echo $this->Form->create('recherche');
			echo $this->Form->input('Officine');
			echo $this->Form->end(__('Rechercher'));
		?>
	</div>
	<div class="logout"><?php echo $this->Html->link('Deconnexion',array(
				'controller'=>'users', 
				'action'=>'logout')) ?>
	</div>
	<div class="clear"></div>
</div>
<div id="sidebar">
	<h2 id="lieu">Infomartion</h2>
	<ul>
		<li><label for="lat">Latitude :</label><span id="lat"></span></li>
		<li><label for="lng">Logitude :</label><span id="lng"></span></li>
	</ul>
	<div class="clear"></div>
	<h2>Menu</h2>
	<ul class="">
		<li>
            <?php  
                echo $this->Html->link('Accueil', array('controller'=>'pharmacies',
                'action'=>'index'));  
            ?>
        </li>
        <li>
            <?php  
                echo $this->Html->link('Ajouter une officine', array('controller'=>'pharmacies',
                'action'=>'add'));  
            ?>
        </li>
        <li>
           <?php  
                echo $this->Html->link('Liste des officines', array('controller'=>'pharmacies',
                'action'=>'liste'));  
            ?> 
        </li>
    </ul>
    <div class="bloc">
    	<ul class="tabs">
   			<li><a href="#tab1">Distance</a></li>
    		<li><a href="#tab2">Itinéraire</a></li>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<?php
					echo $this->Form->create('Distance');
					echo $this->Form->input('origine');
					echo $this->Form->input('destination');
					echo $this->Form->input('latOrigine',array('type'=>'hidden'));
					echo $this->Form->input('lngOrigine',array('type'=>'hidden'));
					echo $this->Form->input('latDestination',array('type'=>'hidden'));
					echo $this->Form->input('lngDestination',array('type'=>'hidden'));
					echo $this->Form->submit('Calculer', array('id'=>'calculer'));
					echo $this->Form->end();
				?>
			</div>
			
			<div id="tab2" class="tab_content">
				itinéraire
			</div>
		</div>
    </div>
    <div id="col_droite">
		<label for="region">Choisir une Région</label>
		<select multiple="" size="4" name="region" id="region">
			<?php foreach ($regions as $region) : $region = $region['Region']; ?>
				<option value="<?php echo $region['nom']; ?>"><?php echo $region['nom']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>
<div id="corps" class="officine">
	<div id="carte" style="width:100%; height:586px;"></div>
</div>
