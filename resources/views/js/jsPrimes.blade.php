<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<h1>Hi</h1>

<label for="prime_input"> Check if number is prime: <input id="prime_input" type="number" value="100"></label>

<button id="factor_button" type="button" class="btn btn-success">Find factors</button>

<h3>Found factors:</h3>
<h3 id="factor_output"></h3>

<label for="find_primes"> Find all primes less than: <input id="find_primes" type="number" value="200"></label>
<button id="prime_button" type="button" class="btn btn-success">Find primes</button>

<h3>Found factors:</h3>
<h3 id="prime_output"></h3>

<script>

    document.querySelector('#factor_button').onclick = handleFactorClick;

    function handleFactorClick(e) {
        // if this is a link - prevent the jump to the top of the page
        // or if this is a form, prevent the form from being submitted - navigation event
        e.preventDefault();

        const candidate = document.querySelector('#prime_input').value;
        const factors = getFactors(candidate);
        displayFactors(factors);
    }

    function handlePrimeClick(e) {
        // if this is a link - prevent the jump to the top of the page
        // or if this is a form, prevent the form from being submitted - navigation event
        e.preventDefault();

        const candidate = document.querySelector('#prime_input').value;
        const primes = findPrimes(candidate);
        displayPrimes(primes);
    }

    // find primes between 2 and max
    function findPrimes(max) {

        let primeCandidates = {};

        for (let primeCandidate = 2; primeCandidate < max; primeCandidate++) {
            primeCandidates[primeCandidate] = getFactors(primeCandidate);
        }


        let primes = [];
        for (let primeCandidate in primeCandidates) {
            if (primeCandidates[primeCandidate].length > 0) {
                // console.log(primeCandidate, 'is not a prime, found factors:', primeCandidates[primeCandidate]);
            } else {
                // console.log(primeCandidate, 'is a prime');
                primes.push()
            }
        }
        return primes;
    }

    function displayPrimes(factors) {
        document.getElementById('prime_output').innerText = factors.length > 0
            ? factors.toString()
            : "No primes found, it's a prime!";
    }



    function getFactors(primeCandidate) {
        let factors = [];

        for (let factorCandidate = 2; factorCandidate < primeCandidate / 2; factorCandidate++) {
            if (primeCandidate % factorCandidate === 0) {
                factors.push(factorCandidate);
            }
        }

        return factors
    }

    function displayFactors(factors) {
        document.getElementById('factor_output').innerText = factors.length > 0
            ? factors.toString()
            : "No factors found, it's a prime!";
    }

</script>

</body>
</html>
