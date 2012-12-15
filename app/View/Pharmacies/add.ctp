<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    $(function() {
        var latlng = new google.maps.LatLng(14.492835,-14.611816);
        var map = new google.maps.Map(document.getElementById('carte'),{
            zoom : 7,
            center: latlng, 
            mapTypeId: google.maps.MapTypeId.ROADMAP
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
                clickable : false,
                icon : positions[iterateur].image
            });
            iterateur++;
        }

        var marker = new google.maps.Marker({
            position : latlng,
            map : map,
            title : 'Sénégal',
            draggable : true
        });

        var geocoder = new google.maps.Geocoder();

        google.maps.event.addListener(marker,'drag',function(){
            setPosition(marker);
        });

        $("#PharmacieRegion").change(function () {
            $("#PharmacieRegion option:selected").each(function () {
                var request = {
                    address : $(this).text(),
                    region : 'SN'
                }
                var options = {
                    backgroundColor: '#ffffff'
                }

                geocoder.geocode(request,function(results,status){
                    //alert(status);
                    if (status == google.maps.GeocoderStatus.OK) {
                        var pos = results[0].geometry.location;
                        map.setCenter(pos);
                        map.setZoom(11);
                        //map.setOptions(options);
                        marker.setPosition(pos);
                        setPosition(marker);
                    }
                });
            });
        });

    });
    function setPosition (marker) {
        var pos = marker.getPosition();
        $('#PharmacieLat').val(pos.lat());
        $('#PharmacieLng').val(pos.lng());
    }
</script>
<div id="session">
    <img src="../images/icon.png" alt=""><span><?php echo "Prince"; ?></span>
    <div class="logout"><?php echo $this->Html->link('Deconnexion',array(
                'controller'=>'users', 
                'action'=>'logout')) ?>
    </div>
</div>
<div id="sidebar">
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
</div>
<div class="add">
<?php $options = array('Sélectionner'); ?>
<?php foreach ($regions as $region) : $region = $region['Region']; ?>
    <?php 
        array_push($options, $region['nom']); 
    ?>
<?php endforeach; ?>

<?php echo $this->Form->create('Pharmacie'); ?>
    <fieldset>
        <legend><?php echo __('Créer une officine'); ?></legend>
    <?php
        echo $this->Form->input('nom');
        echo $this->Form->input('code');
        echo $this->Form->input('lat');
        echo $this->Form->input('lng');
        echo $this->Form->input('Region', array(
            'options' => $options
        ));
        echo $this->Form->input('type', array(
            'options' => array('Pharmacie' => 'Pharmacie', 'Centre de santé' => 'Centre de santé', 'Hopital'=>'Hopital')
        ));
    ?>
    <div id="carte" style="width:95%; height:447px;"></div>
    </fieldset>
<?php echo $this->Form->end(__('Enregistrer')); ?>
<div class="clear"></div>
</div>