document.addEventListener("DOMContentLoaded", function () {
  let age = find("metAge");
  let height = find("metHeight");
  let weight = find("metWeight");
  let male = find("metMale");
  let female = find("metFemale");
  age.addEventListener("input", () => calsPerDay());
  height.addEventListener("input", () => calsPerDay());
  weight.addEventListener("input", () => calsPerDay());
  male.addEventListener("change", () => calsPerDay());
  female.addEventListener("change", () => calsPerDay());
});

function find(id) {
  return document.getElementById(id);
}

function calsPerDay() {
  let age = find("metAge").value;
  let height = find("metHeight").value;
  let weight = find("metWeight").value;
  let result = 0;
  let resultBMI = 0;
  if (find("metMale").checked)
    result = 10 * weight + 6.25 * height - 5 * age + 5;
  else if (find("metFemale").checked)
    result = 10 * weight + 6.25 * height - 5 * age - 161;
  if (age && height && weight && result > 0) {
    resultBMI = (weight * 10000) / height ** 2;
    find("metTotalCals").innerHTML = Math.round(result);
    find("metBMI").innerHTML = resultBMI.toFixed(1);
    switch (true) {
      case resultBMI <= 16:
        find("metSelector").style.margin = "-8px 0px 0px 19px";
        break;
      case resultBMI > 16 && resultBMI <= 18.5:
        find("metSelector").style.margin = "-8px 0px 0px 36px";
        break;
      case resultBMI > 18.5 && resultBMI <= 25:
        find("metSelector").style.margin = "-8px 0px 0px 53px";
        break;
      case resultBMI > 25 && resultBMI <= 30:
        find("metSelector").style.margin = "-8px 0px 0px 68px";
        break;
      case resultBMI > 30 && resultBMI <= 35:
        find("metSelector").style.margin = "-8px 0px 0px 85px";
        break;
      case resultBMI > 35 && resultBMI < 40:
        find("metSelector").style.margin = "-8px 0px 0px 101px";
        break;
      case resultBMI >= 40:
        find("metSelector").style.margin = "-8px 0px 0px 117px";
        break;
      default:
        find("metSelector").style.margin = "-8px 0px 0px 0px";
    }
  }
}
