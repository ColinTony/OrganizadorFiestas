$(document).ready(function(){
	var width = window.innerWidth;
    var height = window.innerHeight;

    function drawImage(imageObj) {
        var stage = new Konva.Stage({
          container: 'container',
          width: width,
          height: height,
    	});
    	var layer = new Konva.Layer();
        // darth vader
        var darthVaderImg = new Konva.Image({
          image: imageObj,
          x: stage.width() / 2 - 200 / 2,
          y: stage.height() / 2 - 137 / 2,
          width: 200,
          height: 137,
          draggable: true,
        });

        // add cursor styling
        darthVaderImg.on('mouseover', function () {
          document.body.style.cursor = 'pointer';
        });
        darthVaderImg.on('mouseout', function () {
          document.body.style.cursor = 'default';
        });

        layer.add(darthVaderImg);
        stage.add(layer);
    };
    var imageObj = new Image();
      imageObj.onload = function () {
        drawImage(this);
    };
    imageObj.src = '/assets/img/banda.png';
});