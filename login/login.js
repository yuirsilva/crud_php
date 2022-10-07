import * as THREE from 'three'
import { ParametricGeometry } from 'https://unpkg.com/three@0.145.0/examples/jsm/geometries/ParametricGeometry.js'

export default class Sketch
{
    constructor(options) {
        this.container = options.domElement

        this.sizes = { width: this.container.offsetWidth, height: this.container.offsetHeight }

        this.scene = new THREE.Scene()

        this.camera = new THREE.PerspectiveCamera(40, this.sizes.width / this.sizes.height, 0.01, 10)
        this.camera.position.z = 2.5
        this.scene.add(this.camera)

        this.renderer = new THREE.WebGLRenderer({
            antialias: true,
            alpha: true
        })
        this.container.appendChild(this.renderer.domElement)

        this.time = Date.now()
        this.flag = false

        this.resize()
        this.parametricFunctions()
        this.addObjects()
        this.render()
        this.setupResize()
        this.setupCanvasClick()
    }

    resize() {
        this.sizes.width = this.container.offsetWidth
        this.sizes.height = this.container.offsetHeight

        this.renderer.setSize(this.sizes.width, this.sizes.height)
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

        this.camera.aspect = this.sizes.width / this.sizes.height
        this.camera.updateProjectionMatrix()
    }

    setupResize() {
        window.addEventListener('resize', this.resize.bind(this))
    }

    parametricFunctions() {
        this.hyperbolic = (u, v, target) =>
        {
            let alpha = Math.PI * 2 * (u - 0.5)
            let theta = Math.PI * 2 * (v - 0.5)
            let t = 5
            let bottom = 1 + Math.cosh(alpha) * Math.cosh(theta)
        
            let x = Math.sinh(alpha) * Math.cos(t * theta) / bottom
            let y = Math.sinh(alpha) * Math.sin(t * theta) / bottom
            let z = Math.cosh(alpha) * Math.sinh(theta) / bottom
            target.set(x, y, z)
        }

        this.sine = (u, v, target) =>
        {
            let alpha = Math.PI * 2 * (u - 0.5)
            let theta = Math.PI * 2 * (v - 0.5)
            let a = 0.6

            let x = a * Math.sin(alpha)
            let y = a * Math.cos(theta) * Math.sin(theta)
            let z = a * Math.sin(alpha + theta)

            target.set(x, y, z)
        }
    }

    addObjects() {
        this.material = new THREE.MeshBasicMaterial({ 
            color: 0x6a7768, 
            wireframe: true, 
            side: THREE.DoubleSide
        })

        this.hyperbolicHelicoid = new THREE.Mesh(
            new ParametricGeometry(this.hyperbolic, 50, 50),
            this.material
        )
        this.hyperbolicHelicoid.rotation.x = Math.PI * 0.5

        this.sineSurface = new THREE.Mesh(
            new ParametricGeometry(this.sine, 60, 60),
            this.material
        )
        this.sineSurface.position.set(0, 4, 0)

        this.scene.add(this.hyperbolicHelicoid, this.sineSurface)
    }

    setupCanvasClick() {
        this.renderer.domElement.addEventListener('mouseenter', this.canvasHover.bind(this))
        this.renderer.domElement.addEventListener('mouseleave', this.canvasHover.bind(this))
        this.renderer.domElement.addEventListener('click', this.canvasClick.bind(this))
    }

    canvasHover() {
        cursor.classList.toggle('click')
    }

    canvasClick() {
        if (!this.flag) {
            gsap.to(this.camera.position, {
                y: 4,
                duration: 2
            })
            this.flag = !this.flag
        } else {
            gsap.to(this.camera.position, {
                y: 0,
                duration: 2
            })
            this.flag = !this.flag
        }
    }

    render() {
        this.currentTime = Date.now()
        this.deltaTime = this.currentTime - this.time
        this.time = this.currentTime

        this.hyperbolicHelicoid.rotation.z += this.deltaTime * 0.0005

        this.sineSurface.rotation.x += this.deltaTime * 0.0005
        this.sineSurface.rotation.y += this.deltaTime * 0.0005

        this.renderer.render(this.scene, this.camera)

        requestAnimationFrame(this.render.bind(this))
    }
}

new Sketch({
    domElement: document.getElementById('container')
})