// slider value showing
(function() {
  const valueBudget = document.getElementById('budget');
  const valueCookingTime = document.getElementById('cooking_time');
  const targetBudget = document.getElementById('target_budget');
  const targetCookingTime = document.getElementById('target_cooking_time');

  const getSliderValue = function(value, target) {
    return function() {
      target.innerHTML = value.value;
    };
  };
  valueBudget.addEventListener('input', getSliderValue(
      valueBudget, targetBudget));
  valueCookingTime.addEventListener('input', getSliderValue(
      valueCookingTime, targetCookingTime));
})();
