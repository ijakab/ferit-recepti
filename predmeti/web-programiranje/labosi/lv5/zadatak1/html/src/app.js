window.onload = function () {
    class App {
        constructor() {
            this.leftCats = []
            this.rightCats = []
            this.selectedLeft = -1
            this.selectedRight = -1
            this.fight = new Fight(this)
        }
        
        load() {
            this.systemMessageElement = document.getElementsByTagName('h2')[0]
            const leftElements = document.getElementById("fighters-left").children
            const rightElements = document.getElementById("fighters-right").children
            const leftSide = document.getElementById('firstSide')
            const rightSide = document.getElementById('secondSide')
            for(let i = 0; i < leftElements.length; i++) {
                const cat = new Cat(leftElements[i], rightElements[i])
                cat.load()
                const leftCatSide = new CatSide(leftSide, leftElements[i], cat, this)
                const rightCatSide = new CatSide(rightSide, rightElements[i], cat, this)
                leftCatSide.load()
                rightCatSide.load()
                this.leftCats.push(leftCatSide)
                this.rightCats.push(rightCatSide)
            }
            this.allCats = [...this.rightCats, ...this.leftCats]
            this.fight.load()
            this.registerCatClickEvents(this.allCats)
            this.registerRandomClickEvent()
            this.formButtons = document.getElementsByClassName('cat-form')
        }
        
        registerCatClickEvents(catSides) {
            for(const catSide of catSides) {
                catSide.element.addEventListener('click', e => this.clickCat(catSide), false)
            }
        }
        
        registerRandomClickEvent() {
            document.getElementById("randomFight").addEventListener('click', e => this.clickRandomFighter(), false)
        }
        
        clickCat(catSide) {
            const leftIndex = this.leftCats.indexOf(catSide)
            const rightIndex = this.rightCats.indexOf(catSide)
            if(leftIndex !== -1) {
                this.selectedLeft = this.handleSide(this.leftCats, this.rightCats, this.selectedLeft, leftIndex)
            } else if (rightIndex !== -1) {
                this.selectedRight = this.handleSide(this.rightCats, this.leftCats, this.selectedRight, rightIndex)
            }
            this.fight.checkFightEnabled()
        }
        
        clickRandomFighter() {
            let left = 0;
            let right = 0;
            while (left === right || left > 5 || right > 5) {
                left = Math.floor(Math.random() * this.leftCats.length)
                right = Math.floor(Math.random() * this.leftCats.length)
            }
            if(left !== this.selectedLeft) this.selectedLeft = this.handleSide(this.leftCats, this.rightCats, this.selectedLeft, left)
            if(right !== this.selectedRight) this.selectedRight = this.handleSide(this.rightCats, this.leftCats, this.selectedRight, right)
            this.fight.checkFightEnabled()
        }
        
        handleSide(clickedSideCats, otherSideCats, previousIndexClickedSide, index) {
            clickedSideCats[index].click()
            if(previousIndexClickedSide !== -1) clickedSideCats[previousIndexClickedSide].enableClick()
            if(previousIndexClickedSide !== -1) otherSideCats[previousIndexClickedSide].enableClick()
            clickedSideCats[index].makeSelected()
            otherSideCats[index].disableClick()
            return index
        }

        disableFormButtonsListener(e)  {
            e.preventDefault()
        }

        disableAll() {
            for(const formButton of this.formButtons) {
                formButton.addEventListener('click', this.disableFormButtonsListener, false)
            }
            for(const cat of this.allCats) {
                cat.disableClick()
            }
        }
        
        restore() {
            for(const formButton of this.formButtons) {
                formButton.removeEventListener('click', this.disableFormButtonsListener)
            }
            for(let i = 0; i < this.leftCats.length; i++) {
                if(i !== this.selectedLeft) {
                    this.rightCats[i].enableClick()
                }
                if(i !== this.selectedRight) {
                    this.leftCats[i].enableClick()
                }
            }
        }
        
        addMessage(message) {
            this.systemMessageElement.innerText = message
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
    
            const imageOverlay = document.createElement('div')
            imageOverlay.classList.add('image_overlay')
            this.leftElement.appendChild(imageOverlay.cloneNode())
            this.rightElement.appendChild(imageOverlay)
        }
        
        win() {
            this.info.record.wins ++
            this.saveInfo()
        }
        
        loss() {
            this.info.record.loss ++
            this.saveInfo()
        }
        
        saveInfo() {
            this.leftElement.setAttribute('data-info', JSON.stringify(this.info))
            this.rightElement.setAttribute('data-info', JSON.stringify(this.info))
        }
    }
    
    class CatSide {
        constructor(sideElement, element, cat, app) {
            this.cat = cat
            this.element = element
            this.sideElement = sideElement
            this.app = app
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
            this.element.classList.remove('selected')
            this.element.classList.add('enabled')
        }
        
        disableClick() {
            this.clickEnabled = false
            this.element.classList.remove('enabled')
            this.element.classList.add('disabled')
        }
        
        makeSelected() {
            this.element.classList.remove('disabled')
            this.element.classList.add('selected')
        }
        
        click() {
            if(!this.clickEnabled) throw 'Click is disable'
            this.imgElement.setAttribute('src', this.cat.imageSource)
            this.nameElement.innerText = this.cat.info.name
            this.ageElement.innerText = this.cat.info.age
            this.skillsElement.innerText = this.cat.info.catInfo
            this.updateRecord()
    
            this.imgElement.classList.remove('win-border')
            this.imgElement.classList.remove('loss-border')
            this.app.addMessage('Choose your cat')
        }
        
        updateRecord() {
            this.recordElement.innerText = `Wins: ${this.cat.info.record.wins} Loss: ${this.cat.info.record.loss}`
        }
        
        win() {
            this.imgElement.classList.remove('loss-border')
            this.imgElement.classList.remove('win-border')
            this.imgElement.classList.add('win-border')
            this.cat.win()
            this.updateRecord()
        }
    
        loss() {
            this.imgElement.classList.remove('loss-border')
            this.imgElement.classList.remove('win-border')
            this.imgElement.classList.add('loss-border')
            this.cat.loss()
            this.updateRecord()
        }
    }
    
    class Fight {
        constructor(app) {
            this.fightEnabled = false
            this.app = app
        }
    
        load() {
            this.fightButton = document.getElementById('generateFight')
            this.checkFightEnabled()
            this.registerFightClickEvent()
        }
    
        checkFightEnabled() {
            this.fightEnabled = Boolean(this.app.selectedLeft !== -1 && this.app.selectedRight !== -1)
            this.fightButton.disabled = !this.fightEnabled
        }
    
        registerFightClickEvent() {
            this.fightButton.addEventListener('click', e => this.click(), false)
        }
        
        async click() {
            if(!this.fightEnabled) throw 'Fight is disabled'
            await this.countDown()
            this.fight()
        }
        
        fight() {
            const leftSide = this.app.leftCats[this.app.selectedLeft]
            const rightSide = this.app.leftCats[this.app.selectedRight]
            const leftRecord = leftSide.cat.info.record
            const rightRecord = rightSide.cat.info.record
            const leftPercentage = leftRecord.wins / (leftRecord.wins + leftRecord.loss)
            const rightPercentage = rightRecord.wins / (rightRecord.wins + rightRecord.loss)
            const diff = Math.abs(leftPercentage - rightPercentage)
            const bias = diff < 0.1 ? 0.1 : 0.2
            const margin = 0.5 + bias
            const generatedNumber = Math.random()
            
            if(leftPercentage > rightPercentage) {
                if(generatedNumber < margin) this.win('left')
                else this.win('right')
            } else {
                if(generatedNumber < margin) this.win('right')
                else this.win('left')
            }
        }
        
        win(side) {
            let winningCatSide
            let otherCatSide
            if(side === 'left') {
                winningCatSide = this.app.leftCats[this.app.selectedLeft]
                otherCatSide = this.app.rightCats[this.app.selectedRight]
            } else {
                winningCatSide = this.app.rightCats[this.app.selectedRight]
                otherCatSide = this.app.leftCats[this.app.selectedLeft]
            }
            winningCatSide.win()
            otherCatSide.loss()
            this.app.addMessage(`The winner is ${winningCatSide.cat.info.name}`)
            this.sendInfoToServer(winningCatSide, otherCatSide)
        }

        sendInfoToServer(winningCatSide, otherCatSide) {
            const formData = new FormData();
            formData.append('wins', winningCatSide.cat.info.id);
            formData.append('loss', otherCatSide.cat.info.id);
            fetch('/fight.php', {
                method: 'POST',
                body: formData
            })
        }
        
        countDown() {
            return new Promise(resolve => {
                this.app.disableAll()
                let counter = 3
                const interval = setInterval(_ => {
                    this.app.addMessage(counter)
                    if(counter === 0) {
                        clearInterval(interval)
                        this.app.restore()
                        resolve()
                    }
                    counter --
                }, 1000)
            })
        }
    }
    
    const app = new App()
    app.load()

}
