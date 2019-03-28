


  if ( WEBGL.isWebGLAvailable() === false ) {

    document.body.appendChild( WEBGL.getWebGLErrorMessage() );

  }

  var container, stats, clock;
  var camera, scene, renderer, car;

  init();
  animate();

  function init() {

    container = document.getElementById( 'container' );
    var instructions = document.getElementById( 'instructions' );

    camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.1, 2000 );
    camera.position.set( 20, 5, 1 );
    camera.lookAt( 0, 1, 0 );


    scene = new THREE.Scene();

    clock = new THREE.Clock();



  //	scene.add( controls.getObject() );


    // loading manager

    var loadingManager = new THREE.LoadingManager( function() {

      scene.add( car );

    } );
    var path = "image/background/";
    var format = '.png';
    var directions = ["left", "right", "up", "down", "front", "back"];

    var materialArray = [];
    for (var i = 0; i < 6; i++)
    materialArray.push (new THREE.MeshPhongMaterial({
      map : THREE.ImageUtils.loadTexture(path + directions[i] + format),
      side : THREE.BackSide
    }));

    var skyGeometry = new THREE.CubeGeometry(500,500,500);
    var skyMaterial = new THREE.MeshFaceMaterial(materialArray);
    var skyBox = new THREE.Mesh(skyGeometry, skyMaterial);
    //skyBox.rotation.x += Math.PI /2;
    scene.add( skyBox );


    //base
    var texture = new THREE.TextureLoader().load( 'image/background/down.png');
    var geometry = new THREE.BoxBufferGeometry( 500, 1, 500 );
    var material = new THREE.MeshPhongMaterial( { map: texture } );
    var mesh = new THREE.Mesh( geometry, material );
    mesh.position.set(0, -20, 0);
    mesh.receiveShadow = true;
    scene.add( mesh );


    // collada

    var loader = new THREE.ColladaLoader( loadingManager );
    loader.load( 'model.dae', function ( collada ) {

      car = collada.scene;
      car.position.set(-10,-5,-10)
      car.scale.set(0.01,0.01,0.01);

    } );

    //

    var ambientLight = new THREE.AmbientLight( 0xcccccc, 0.4 );
    scene.add( ambientLight );

    var directionalLight = new THREE.DirectionalLight( 0xffffff, 0.8 );
    directionalLight.position.set( 1, 1, 0 ).normalize();
    scene.add( directionalLight );

    //

    renderer = new THREE.WebGLRenderer();
    renderer.setPixelRatio( window.devicePixelRatio );
    renderer.setSize( window.innerWidth, window.innerHeight );
    container.appendChild( renderer.domElement );

    //

    stats = new Stats();
    container.appendChild( stats.dom );

    //

    window.addEventListener( 'resize', onWindowResize, false );

  }

  function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight );

  }

  function animate() {

    requestAnimationFrame( animate );

    render();
    stats.update();

  }

  let carIn = 1;
  let varTurn = 0.0004;
  function render() {

    var delta = clock.getDelta();

    if ( car !== undefined ) {
    camera.lookAt(car.position);
    camera.position.set(car.position.x+20,car.position.y+10,car.position.z-10);
    if (car.position.z > 225){
      carIn = 0;
    }
    if (car.position.z < -225){
      carIn = 1;
    }
    if(carIn == 0){
      //car.position.z-=1;
      car.rotation.z-=0.0135+varTurn;
      car.position.z-=1;
      //car.position.x-=1;
    }
    if(carIn ==1){
      car.rotation.z -=0.0135+varTurn;
      car.position.z+=1;
    }



    }

    renderer.render( scene, camera );

  }
