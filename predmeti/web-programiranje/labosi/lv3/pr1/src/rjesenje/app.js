// api: https://baconipsum.com/api/?type=meat-and-filler

class LoremGenerator {
    constructor(api) {
      this.api = api;
    }
  
    init() {
      this._clickHandler();
    }
  
    _clickHandler() {
      const button = document.querySelector(".btn-primary");
  
      button.addEventListener("click", (e) => {
        e.preventDefault();
        this._generateQuote(this.api);
      });
    }
  
    async _generateQuote(api) {
      let element = document.createElement("p");
      let attr = document.createAttribute("class");
      let text = await this._fetchUrlData(api);
  
      this._createElement(element, attr, text);
    }
  
    async _fetchUrlData(url) {
      const data = await fetch(url);
      let item = await data.json();
      return item[Math.floor(Math.random() * item.length)];
    }
  
    _createElement(element, attr, text) {
      const textNode = document.createTextNode(text);
      const content = document.querySelector(".content");
  
      attr.value = "jumbotron";
      element.setAttributeNode(attr);
      element.appendChild(textNode);
      content.appendChild(element);
    }
  }
  
  const loremGeneratorObj = new LoremGenerator(
    "https://baconipsum.com/api/?type=meat-and-filler"
  );
  
  loremGeneratorObj.init();
  