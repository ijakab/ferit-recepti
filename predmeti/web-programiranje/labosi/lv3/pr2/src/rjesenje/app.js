class ImageFilter {
  constructor(buttons, images) {
    this.buttons = buttons;
    this.images = images;
  }

  init() {
    this._clickHandler(this.buttons);
  }

  _clickHandler(buttons) {
    for (let key in buttons) {
      if (buttons.hasOwnProperty(key)) {
        const buttonEl = document.querySelector(buttons[key]);

        buttonEl.addEventListener("click", (e) => {
          e.preventDefault();
          const buttonType = buttonEl.id.substring(3).toLowerCase();
          this._filterImage(buttonType);
        });
      }
    }
  }

  _filterImage(buttonType) {
    const imagesEl = document.querySelectorAll(this.images);

    Array.from(imagesEl).forEach((item) => {
      const type = JSON.parse(item.dataset.info).type;

      if (type !== buttonType) {
        item.style.display = "none";
      } else {
        item.style.display = "block";
      }

      if (buttonType === "reset") {
        item.style.display = "block";
      }
    });
  }
}

let ferit = {
  buttons: {
    cat: "#btnCat",
    dog: "#btnDog",
    reset: "#btnReset",
  },
  image: ".filter-image",
};

const imageFilterObj = new ImageFilter(ferit.buttons, ferit.image);
imageFilterObj.init();
