import * as THREE from 'three'

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

    addObjects() {
        this.vertexShader = document.getElementById('vertexShader').textContent
        this.fragmentShader = document.getElementById('fragmentShader').textContent
        
        this.material = new THREE.ShaderMaterial({ 
            wireframe: true,
            side: THREE.DoubleSide,
            uniforms: {
                u_time: { value: 1. },
                u_resolution: { value: new THREE.Vector2() },
                u_clickEvent: { value: 1. }
            },
            fragmentShader: this.fragmentShader,
            vertexShader: this.vertexShader
        })
        
        this.blob = new THREE.Mesh(
            new THREE.DodecahedronGeometry(0.5, 10),
            this.material
        )
        this.scene.add(this.blob)
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
            gsap.to(this.material.uniforms.u_clickEvent, {
                value: 4,
                duration: 1
            })
            this.flag = !this.flag
        } else {
            gsap.to(this.material.uniforms.u_clickEvent, {
                value: 1,
                duration: 1
            })
            this.flag = !this.flag
        }
    }

    render() {
        this.currentTime = Date.now()
        this.deltaTime = this.currentTime - this.time
        this.time = this.currentTime

        this.material.uniforms.u_time.value += this.deltaTime * 0.001

        this.renderer.render(this.scene, this.camera)

        requestAnimationFrame(this.render.bind(this))
    }
}

new Sketch({
    domElement: document.getElementById('container')
})