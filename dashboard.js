// load saved values
let main = localStorage.getItem("mainBalance") || 3000;
let profit = localStorage.getItem("profitBalance") || 100;

// convert to number
main = Number(main);
profit = Number(profit);

// display
document.getElementById("mainBalance").innerText = "$" + main;
document.getElementById("profitBalance").innerText = "$" + profit;


// deposit function
function deposit() {
  let amount = prompt("Enter deposit amount:");

  amount = Number(amount);

  if (amount > 0) {
    main += amount;
    localStorage.setItem("mainBalance", main);
    updateUI();
  }
}


// invest function
function invest() {
  let amount = prompt("Enter investment amount:");

  amount = Number(amount);

  if (amount > 0 && amount <= main) {
    main -= amount;

    // profit (10%)
    let gain = amount * 0.1;
    profit += gain;

    localStorage.setItem("mainBalance", main);
    localStorage.setItem("profitBalance", profit);

    updateUI();
  } else {
    alert("Insufficient balance");
  }
}


// update UI
function updateUI() {
  document.getElementById("mainBalance").innerText = "$" + main;
  document.getElementById("profitBalance").innerText = "$" + profit;
}