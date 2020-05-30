class App {
    constructor(form, x) {
        this.form = form;
        this.x = x;
    }

    init() {
        this._submitFormData(this.form);
        this._removeTodo(this.x);
    }

    _submitFormData(selector) {
        const myForm = document.querySelector(selector);

        myForm.addEventListener("submit", function (e) {
            e.preventDefault();

            if (!this.children[0].value) {
                alert("Field is empty")
                return;
            }

            /**
             * https://developer.mozilla.org/en-US/docs/Web/API/FormData
             * @type {FormData}
             */
            const data = new FormData(this);

            fetch('controller/db/Insert.php', {
                method: 'post',
                body: data
            })
                .then(response => response.text())
                .then(response => {
                    /**
                     * If 200, reload the page
                     */
                    location.reload();
                })
                .catch(error => alert(error));
        });
    }

    _removeTodo(selector) {
        const x = document.querySelectorAll(selector);

        Array.from(x).forEach(element => {
            element.addEventListener("click", function (e) {
                e.preventDefault();

                fetch('controller/db/Delete.php?id=' + this.id, {
                    method: 'get',
                }).then(response => response.text())
                    .then(response => {
                        /**
                         * If status 200, reload the page
                         */
                        location.reload();
                    })
                    .catch(error => alert(error));
            });
        })
    }
}

const ferit = {
    form: "form",
    delete: "i"
}

const app = new App(ferit.form, ferit.delete);
app.init();
