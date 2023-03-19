document.addEventListener("DOMContentLoaded", function () {
    let search = document.getElementById("inputCity");
    let elements = document.querySelectorAll(".city");
    let inputBox = document.getElementById("inputBox");
    if (search) {
        search.addEventListener("input", function () {
            let reg = new RegExp(search.value.toLowerCase());
            let newElements = document.querySelectorAll(".newCity");
            newElements.forEach((newElement) => {
                newElement.remove();
            });
            elements.forEach((element) => {
                if (
                    reg.test(element.textContent.toLowerCase()) &&
                    search.value != ""
                ) {
                    inputBox.insertAdjacentHTML(
                        "afterEnd",
                        `<li class = "newCity shadow">${element.innerHTML}</li>`
                    );
                }
            });
        });
    }
});
