import * as THREE from 'three';


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

// class graphic {
// 	domain = {
// 		canvas: null,
// 		scene: null,
// 		camera: null,
// 		controls: null,
// 		topLight: null,
// 		ambientLight: null
// 	}
// 	config = {
// 		width: 380,
// 		height: 600,
// 		assets: [],
// 	}
// 	constructor(canvas) {
// 		this.domain.canvas = canvas;
// 	}
// 	initialise() {
// 		this.domain.scene = new THREE.Scene();
// 		this.setCamera()
// 		this.setTopLighting();
// 		this.setAmbientLight();
// 	}
// 	addToScene(asset) {
// 		this.domain.scene.add(asset);
// 	}
// 	setCamera() {
// 		const camera = new THREE.PerspectiveCamera(45, this.config.width / this.config.height, 0.1, 1000);
// 		camera.position.set(0, 10, 50);
// 		this.domain.camera = camera;
// 		this.addToScene(this.domain.camera);
// 	}
// 	setTopLighting() {
// 		const topLight = new THREE.DirectionalLight(0xffffff, 2.5);
//         topLight.position.set(0, 1, 1)
//         topLight.castShadow = true;
// 		this.domain.topLight = topLight
// 		this.addToScene(this.domain.topLight)
// 	}
// 	setAmbientLight() {
// 		const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
// 		this.domain.ambientLight = ambientLight;
// 		this.addToScene(this.domain.ambientLight);
// 	}
// }