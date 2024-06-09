/**
 *
 */
class Scene {
    dimensions = { width: null, height: null };
    domain = {
        canvas: null,
        ctx: null,
        particles: [],
        animationFrame: null
    }
    constructor(container) {
        this.dimensions.width = container.offsetWidth;
        this.dimensions.height = container.offsetHeight;
        return this.init()
    }
    init() {
        this.domain.canvas = document.getElementById('c_particles');
        this.domain.ctx = this.domain.canvas.getContext('2d');
        this.domain.canvas.width = this.dimensions.width;
        this.domain.canvas.height = this.dimensions.height;
        return this;
    }
    setup() {
        const limit = this.particlesToProduce();
        for (let i = 0; i < limit; i++) {
            const size = this.randInt(2, 7);
            const x = this.randInt(size / 2, this.dimensions.width - size / 2);
            const y = this.randInt(size / 2, this.dimensions.height - size / 2);
            const vx = Math.random() < 0.5 ? -0.2 : 0.2;
            const vy = Math.random() < 0.5 ? -0.2 : 0.2;
            this.domain.particles.push(new Particle(x, y, size, vx, vy, this.dimensions))
        }
        this.animateLoop()
        return this
    }
    particlesToProduce() {
        let produce = 15;
        const { width } = this.dimensions;
        if (width >= 601 && width < 1200) produce = 25;
        if (width >= 1201 && width < 1500) produce = 35;
        if (width >= 1501) produce = 55;
        return produce;
    }
    animateLoop = () => {
        this.update();
        this.draw();
        this.domain.animationFrame = requestAnimationFrame(this.animateLoop)
    }
    randInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
    draw() {
        this.domain.ctx.clearRect(0, 0, this.domain.canvas.width, this.domain.canvas.height);

        let i = 0;
        for (const particle of this.domain.particles) {
            particle.draw(this.domain.ctx);
            this.checkCollide(particle, i)
            i++
        }
    }
    checkCollide(particle, iteration) {
        const {x: px, y: py, size} = particle
        const radius = size / 2;

        for (let k = 0; k < this.domain.particles.length; k++) {
            if (iteration == k) {
                continue;
            }
            
            const {x: kx, y: ky} = this.domain.particles[k];
            if (px >= kx - radius && px <= kx + radius) {
                if (py >= ky - radius && py <= ky + radius) {
                    particle.collide()
                    this.domain.particles[k].collide()
                    break;
                }
            }
        }
    }
    update() {
        for (const particle of this.domain.particles) {
            particle.update();
        }
    }
    restart = () => {
        this.domain.particles.length = 0;
        window.cancelAnimationFrame(this.domain.animationFrame)
    }
}

/**
 *
 */
class Particle  {
    dimensions = { width: null, height: null }
    color = '#4338ca';
    constructor(x, y, size, vx, vy, dimensions) {
        this.x = x;
        this.y = y;
        this.size = size;
        this.vx = vx;
        this.vy = vy;
        this.dimensions = dimensions
    }
    getRadius() {
        return this.size / 2
    }
    update() {
        if (this.x < 0 || this.x > this.dimensions.width) {
            this.vx *= -1;
        }
        if (this.y < 0 || this.y > this.dimensions.height) {
            this.vy *= -1;
        }
        this.x += this.vx;
        this.y += this.vy;
    }
    draw(ctx) {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.getRadius(), 0, Math.PI * 2, true);
        ctx.closePath();
        ctx.fillStyle = this.color;
        ctx.fill();
    }
    collide() {
        this.vx *= -1;
        this.vy *= -1;
    }
}

const container = document.getElementById('c_container')
let scene = new Scene(container);

window.addEventListener('load', () => scene.setup())
window.addEventListener('resize', processRestart(() => restart()))

/**
 *
 */
function processRestart(cb) {
    let timer;
    return () => {
        clearTimeout(timer);
        timer = setTimeout(cb, 200);
    };
}

/**
 *
 */
function restart() {
    scene.restart();
    scene = new Scene(container);
    scene.setup();
 }