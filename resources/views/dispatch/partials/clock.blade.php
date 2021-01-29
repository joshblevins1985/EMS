<style>
    .clock {

        color: #17D4FE;
        font-size: 60px;
        font-family: Orbitron;
        letter-spacing: 7px;
    }
</style>
<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
<div id="txt"></div>

<script>
    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59


        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();
</script>