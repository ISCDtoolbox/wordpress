var url = window.frameElement.src;
var path = url.split('#')[1];
var root = url.split('#')[2];

if (!Detector.webgl) {
  Detector.addGetWebGLMessage();
}

var container;

var camera, controls, scene, renderer;
var lighting, ambient, keyLight, fillLight, backLight;

var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;


init();
animate();

function init() {

  container = document.getElementById("container");

  /* Camera */

  camera = new THREE.PerspectiveCamera(40, window.innerWidth / window.innerHeight, 0.01, 1000);
  camera.position.z = -3;

  /* Scene */

  scene = new THREE.Scene();
  lighting = true;

  ambient = new THREE.AmbientLight(0xffffff, 1.0);
  ambient.intensity = 0.25;
  scene.add(ambient);

  keyLight = new THREE.DirectionalLight(new THREE.Color('hsl(30, 50%, 75%)'), 0.7);
  keyLight.position.set(-100, 0, 100);

  fillLight = new THREE.DirectionalLight(new THREE.Color('hsl(240, 50%, 75%)'), 0.5);
  fillLight.position.set(100, 0, 100);

  backLight = new THREE.DirectionalLight(0xffffff, 0.7);
  backLight.position.set(100, 0, -100).normalize();

  scene.add(keyLight);
  scene.add(fillLight);
  scene.add(backLight);

  /* Model */
  var mtlLoader = new THREE.MTLLoader();
  mtlLoader.setBaseUrl(path);
  mtlLoader.setPath(path);
  mtlLoader.load(root+'.mtl', function (materials) {
    materials.preload();
    /*materials.materials.default.map.magFilter = THREE.NearestFilter;
    materials.materials.default.map.minFilter = THREE.LinearFilter;*/
    materials.materials.default.normalMap = THREE.ImageUtils.loadTexture(path+'normals.png');
    var objLoader = new THREE.OBJLoader();
    objLoader.setMaterials(materials);
    objLoader.setPath(path);
    objLoader.load(root+'.obj', function (object) {
      scene.add(object);
    });
  });

  /* Renderer */

  renderer = new THREE.WebGLRenderer();
  renderer.setPixelRatio(window.devicePixelRatio);
  renderer.setSize(window.innerWidth, window.innerHeight);
  renderer.setClearColor(0x181818);

  container.appendChild(renderer.domElement);

  /* Controls */

  controls = new THREE.OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;
  controls.dampingFactor = 1;
  controls.enableZoom = true;

  /* Events */

  window.addEventListener('resize', onWindowResize, false);
  window.addEventListener('keydown', onKeyboardEvent, false);

}

function onWindowResize() {

  windowHalfX = window.innerWidth / 2;
  windowHalfY = window.innerHeight / 2;

  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);

}

function onKeyboardEvent(e) {

  if (e.code === 'KeyL') {

    lighting = !lighting;

    if (lighting) {

      ambient.intensity = 0.25;
      scene.add(keyLight);
      scene.add(fillLight);
      scene.add(backLight);

    } else {

      ambient.intensity = 1.0;
      scene.remove(keyLight);
      scene.remove(fillLight);
      scene.remove(backLight);

    }

  }

}

function animate() {

  requestAnimationFrame(animate);

  controls.update();

  render();

}

function render() {

  renderer.render(scene, camera);

}
