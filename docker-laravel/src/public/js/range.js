// slider value showing
(function () {
  var valueBudget = document.getElementById('budget');
  var valueCookingTime = document.getElementById('cooking_time');
  var targetBudget = document.getElementById('target_budget');
  var targetCookingTime = document.getElementById('target_cooking_time');

  var getSliderValue = function (value, target) {
    return function () {
      target.innerHTML = value.value;
    };
  };
  valueBudget.addEventListener('input', getSliderValue(valueBudget, targetBudget));
  valueCookingTime.addEventListener('input', getSliderValue(valueCookingTime, targetCookingTime));
})();
