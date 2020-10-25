$(document).ready(function(){
	var width = window.innerWidth*.54;
    var height = window.innerHeight;
    var layer = new Konva.Layer();
    // añadiendo componentes
    var imgBanda = new Image();
    // bocina
    var imgBocina = new Image();
    var imgBocina2 = new Image();
    // mesas
    var imgMesa1 = new Image();
    var imgMesa2 = new Image();
    var imgMesa3 = new Image();
    var imgMesa4 = new Image();
    var imgMesa5 = new Image();
    var imgMesa6 = new Image();
    // meseros
    var imgMesero1 = new Image();
    var imgMesero2 = new Image();
    var imgMesero3 = new Image();
    // pista
    var imgPista = new Image();
      
    //bocina src
    imgBocina.src = '/assets/img/bocinas.png';
    imgBocina2.src = '/assets/img/bocinas.png';
    // banda src
    imgBanda.src = '/assets/img/banda.png';
    // mesas src
    imgMesa1.src='/assets/img/mesa.png';
    imgMesa2.src='/assets/img/mesa.png';
    imgMesa3.src='/assets/img/mesa.png';
    imgMesa4.src='/assets/img/mesa.png';
    imgMesa5.src='/assets/img/mesa.png';
    imgMesa6.src='/assets/img/mesa.png';
    // meseros src
    imgMesero1.src='/assets/img/mesero.png';
    imgMesero2.src='/assets/img/mesero.png';
    imgMesero3.src='/assets/img/mesero.png';
    // pista src
    imgPista.src = '/assets/img/pista3.png';
    
    var stage = new Konva.Stage({
    	container: 'container',
    	width: width,
    	height: height,
    });
    

    function ajaxInvitados(mesa)
    {
    	// procesmos la url
    	var url = window.location.pathname;
    	url = url.split("/");
    	url=url[url.length-1];
    	$("#numeroMesa").text("Mesa "+mesa);
    	$.ajax({
    		url: '/dashboard/ajax/mesa/'+mesa+'/'+url,
    		type: 'GET',
    		dataType:'JSON'
    	})
    	.done(function(resp) {
    		$("#listaInv").empty();
    		var item;
    		$.each(resp['invitados'],function(index, el) {
    			item = "<li>"+el.nombre+"</li>";
    			$("#listaInv").append(item);
    		});
    	})
    	.fail(function(resp) {
    		console.log("error");
    		alert(resp);
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	
    }
    function downloadURI(uri, name) {
        var link = document.createElement('a');
        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        delete link;
    }
    var text = new Konva.Text({
        x: 10,
        y: 10,
        fontFamily: 'Calibri',
        fontSize: 24,
        text: '',
        fill: 'black',
    });

    function writeMessage(message)
    {
        text.text(message);
        layer.draw();
    }
    /*
    	funcnion para dibuajar la imagen
    */
    function drawImage(imageObj,posX,posY,widthImg,heightImg) {
        var img = new Konva.Image({
          image: imageObj,
          x: posX,
          y: posY,
          width: widthImg,
          height: heightImg,
          draggable: true,
        });
        
        // add cursor styling
        img.on('mouseover', function () {
          document.body.style.cursor = 'move';
          writeMessage('x:'+img.absolutePosition().x+' '+'y:'+img.absolutePosition().y);
        });
        img.on('mouseout', function () {
          document.body.style.cursor = 'default';
          writeMessage('');
        });

        layer.add(img);
        stage.add(layer);
      }
      function drawImageMesas(imageObj,posX,posY,widthImg,heightImg,idImg) {
        var img = new Konva.Image({
          image: imageObj,
          x: posX,
          y: posY,
          id: idImg,
          width: widthImg,
          height: heightImg,
          draggable: true,
        });
        
        // add cursor styling
        img.on('mouseover', function () {
          document.body.style.cursor = 'move';
          writeMessage('x:'+img.absolutePosition().x+' '+'y:'+img.absolutePosition().y);
          ajaxInvitados(img.getAttr('id'));
          
        });
        img.on('mouseout', function () {
          document.body.style.cursor = 'default';
          writeMessage('');
        });

        layer.add(img);
        stage.add(layer);
      }
      layer.add(text);
      
      // pintando banda
      drawImage(imgBanda,50,40,300,250);
      // pintando mesas
      drawImageMesas(imgMesa1,460,1,150,137,"1");
      drawImageMesas(imgMesa2,650,1,150,137,"2");
      drawImageMesas(imgMesa3,460,225,150,137,"3");
      drawImageMesas(imgMesa4,650,225,150,137,"4");
      drawImageMesas(imgMesa5,25,420,150,137,"5");
      drawImageMesas(imgMesa6,260,420,150,137,"6");
      // pintando meseros
      drawImage(imgMesero1,366,123,100,100);
      drawImage(imgMesero2,665,123,100,100);
      drawImage(imgMesero3,160,519,100,100);
      // pintando pista
      drawImage(imgPista,495,430,300,300);
      // bocina
      drawImage(imgBocina,45,270,80,100);
      drawImage(imgBocina2,290,270,80,100);

      // guradar imagen de posiciones
      $("#save").click(function() {
      	var dataURL = stage.toDataURL({ pixelRatio: 3 });
        downloadURI(dataURL, 'evento.png');
      });
});