'use strict'
void function ($) {
    const animationConfig = {
        animationInterval: null,
        moveStep: 1,
        pointDiameter: 16,
        animationSpeed: 40
    };

    $(() => {
        initBackground();
        bindStopAnimation();
    })

    function initBackground() {
        let livePoints = $('#live-background .live-point');

        if (livePoints.length === 0)
            return;

        $.each(livePoints, (ix, lp) => {
            randomizeLivePoint($(lp))
        })

        animationConfig.animationInterval = setInterval(animateBackground, animationConfig.animationSpeed);
    }

    function bindStopAnimation() {
        $("body").click(() => {
            if (animationConfig.animationInterval != null)
                clearInterval(animationConfig.animationInterval);
        })
    }

    function animateBackground() {
        let livePoints = $('#live-background .live-point');

        if (livePoints.length === 0)
            return;

        $.each(livePoints, (ix, lp) => {
            moveLivePoint($(lp));
        })
    }

    function randomizeLivePoint(lp) {
        const directions = ['tl', 'tr', 'bl', 'br'];
        const sizes = [50, 75, 100, 125, 150];

        const random_direction_ix = randomIntFromInterval(0, 3);
        const random_size_ix = randomIntFromInterval(0, 4);
        const random_pt = randomIntFromInterval(0, window.innerHeight - animationConfig.pointDiameter);
        const random_pl = randomIntFromInterval(0, window.innerWidth - animationConfig.pointDiameter);
        lp.addClass(`size-${sizes[random_size_ix]}`);
        setLivePointPos(lp, random_pt, random_pl, directions[random_direction_ix]);
    }

    function moveLivePoint(lp) {
        let d = lp.attr('data-direction');
        let pt = parseInt(lp.attr('data-pt'));
        let pl = parseInt(lp.attr('data-pl'));
        pt += d.startsWith("b") ? animationConfig.moveStep : -animationConfig.moveStep;
        pl += d.endsWith("r") ? animationConfig.moveStep : -animationConfig.moveStep;

        if (pt < 0) {
            pt = 0;
            d = d === "tl" ? "bl" : "br";
        } else if ((pt + animationConfig.pointDiameter) >= window.innerHeight) {
            pt = window.innerHeight - animationConfig.pointDiameter;
            d = d === "bl" ? "tl" : "tr";
        }

        if (pl < 0) {
            pl = 0;
            d = d === "tl" ? "tr" : "br";
        } else if ((pl + animationConfig.pointDiameter) >= window.innerWidth) {
            pl = window.innerWidth - animationConfig.pointDiameter;
            d = d === "tr" ? "tl" : "bl";
        }

        setLivePointPos(lp, pt, pl, d);
    }

    function setLivePointPos(lp, pt, pl, dir) {
        lp.attr('data-direction', dir);
        lp.attr("data-pt", pt);
        lp.attr("data-pl", pl);
        lp.css("top", `${pt}px`);
        lp.css("left", `${pl}px`);
    }

    function randomIntFromInterval(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min)
    }

}(jQuery)
