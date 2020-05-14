window.onload = function () {
    class App {
        constructor() {
            this.leftCats = []
            this.rightCats = []
            this.selectedLeft = -1
            this.seletedRigh = -1
        }
        
        load() {
            const leftElements = document.getElementById("fighters-left").children
            const rightElements = document.getElementById("fighters-right").children
            const leftSide = document.getElementById('firstSide')
            const rightSide = document.getElementById('secondSide')
            for(let i = 0; i < leftElements.length; i++) {
                const cat = new Cat(leftElements[i], rightElements[i])
                cat.load()
                const leftCatSide = new CatSide(leftSide, leftElements[i], cat)
                const rightCatSide = new CatSide(rightSide, rightElements[i], cat)
                leftCatSide.load()
                rightCatSide.load()
                this.leftCats.push(leftCatSide)
                this.rightCats.push(rightCatSide)
            }
            this.allCats = [...this.rightCats, ...this.leftCats]
            this.registerCatClickEvents(this.allCats)
        }
        
        registerCatClickEvents(catSides) {
            for(const catSide of catSides) {
                catSide.element.addEventListener('click', e => this.clickCat(catSide), false)
            }
        }
        
        clickCat(catSide) {
            const leftIndex = this.leftCats.indexOf(catSide)
            const rightIndex = this.rightCats.indexOf(catSide)
            if(leftIndex !== -1) {
                this.selectedLeft = this.handleSide(this.leftCats, this.rightCats, this.selectedLeft, leftIndex)
            } else if (rightIndex !== -1) {
                this.seletedRigh = this.handleSide(this.rightCats, this.leftCats, this.seletedRigh, rightIndex)
            }
        }
        
        handleSide(clickedSideCats, otherSideCats, previousIndexClickedSide, index) {
            clickedSideCats[index].click()
            if(previousIndexClickedSide !== -1) clickedSideCats[previousIndexClickedSide].enableClick()
            if(previousIndexClickedSide !== -1) otherSideCats[previousIndexClickedSide].enableClick()
            clickedSideCats[index].disableClick()
            otherSideCats[index].disableClick()
            return index
        }
    }
    
    class Cat {
        constructor(leftElement, rightElement) {
            this.leftElement = leftElement.getElementsByClassName('fighter-box')[0]
            this.rightElement = rightElement.getElementsByClassName('fighter-box')[0]
        }
        
        load() {
            const rawData = this.leftElement.getAttribute('data-info')
            this.info = JSON.parse(rawData)
            this.imageSource = this.leftElement.getElementsByTagName('img')[0].getAttribute('src')
        }
    }
    
    class CatSide {
        constructor(sideElement, element, cat) {
            this.cat = cat
            this.element = element
            this.sideElement = sideElement
            this.enableClick()
        }
        
        load() {
            this.imgElement = this.sideElement.getElementsByClassName('featured-cat-fighter-image')[0]
            this.nameElement = this.sideElement.getElementsByClassName('name')[0]
            this.ageElement = this.sideElement.getElementsByClassName('age')[0]
            this.skillsElement = this.sideElement.getElementsByClassName('skills')[0]
            this.recordElement = this.sideElement.getElementsByClassName('record')[0]
        }
        
        enableClick() {
            this.clickEnabled = true
            this.element.classList.remove('disabled')
            this.element.classList.add('enabled')
        }
        
        disableClick() {
            this.clickEnabled = false
            this.element.classList.remove('enabled')
            this.element.classList.add('disabled')
        }
        
        click() {
            if(!this.clickEnabled) throw 'Click is disable'
            this.imgElement.setAttribute('src', this.cat.imageSource)
            this.nameElement.innerText = this.cat.info.name
            this.ageElement.innerText = this.cat.info.age
            this.skillsElement.innerText = this.cat.info.catInfo
            this.recordElement.innerText = `Wins: ${this.cat.info.record.wins} Loss: ${this.cat.info.record.loss}`
        }
    }
    
    const app = new App()
    app.load()
    console.log(app)
    
    
}
