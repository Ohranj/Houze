const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
const parentElem = document.getElementById('graphic');
const renderer = new THREE.WebGLRenderer();

const geometry = new THREE.BoxGeometry( 1, 1, 1 );
const material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
const cube = new THREE.Mesh( geometry, material );

renderer.setSize( window.innerWidth / 1.75, window.innerHeight / 2 );
renderer.setAnimationLoop( animate );
parentElem.appendChild( renderer.domElement );
scene.add( cube );
camera.position.z = 3;

function animate() {
	cube.rotation.x += 0.01;
	cube.rotation.y += 0.01;
	renderer.render( scene, camera );
}