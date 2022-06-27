'use strict'
void function ($) {
    const animationConfig = {
        animationInterval: null, moveStep: 1, pointDiameter: 16, animationSpeed: 60
    };

    $(() => {
        initBackground();
        initTheme();
    })

    function initBackground() {
        bindStopAnimation();
        bindStartAnimation();
        bindRandomizeAnimation();
        randomizePoints();
        startAnimation();
    }

    function startAnimation() {
        animationConfig.animationInterval = setInterval(animateBackground, animationConfig.animationSpeed);
    }

    function randomizePoints() {
        let livePoints = $('#live-background .live-point');

        if (livePoints.length === 0) return;

        $.each(livePoints, (ix, lp) => {
            randomizeLivePoint($(lp))
        })
    }

    function initTheme() {
        $(".js-theme-dark").hide();

        bindSwitchLightTheme();
        bindSwitchDarkTheme();
    }

    function bindSwitchLightTheme() {
        $(".js-theme-light").click(() => {
            let body = $("body");
            if (body.hasClass("theme-dark")) {
                body.removeClass("theme-dark")
            }
            body.addClass("theme-light")
            $(".js-theme-dark").show();
            $(".js-theme-light").hide();
        });
    }

    function bindSwitchDarkTheme() {
        $(".js-theme-dark").click(() => {
            let body = $("body");
            if (body.hasClass("theme-light")) {
                body.removeClass("theme-light")
            }
            body.addClass("theme-dark")
            $(".js-theme-dark").hide();
            $(".js-theme-light").show();
        });
    }

    function bindStopAnimation() {
        $(".js-stop-animation").click(() => {
            if (animationConfig.animationInterval != null) {
                clearInterval(animationConfig.animationInterval);
                animationConfig.animationInterval = null;
                $(".js-stop-animation").hide();
                $(".js-start-animation").show()
                $(".js-randomize-animation").show()
            }
        })
    }

    function bindStartAnimation() {
        $(".js-start-animation").click(() => {
            if (animationConfig.animationInterval == null) {
                startAnimation();
                $(".js-start-animation").hide()
                $(".js-randomize-animation").hide()
                $(".js-stop-animation").show()
            }
        })
    }

    function bindRandomizeAnimation() {
        $(".js-randomize-animation").click(() => {
            if (animationConfig.animationInterval == null) {
                randomizePoints();
            }
        })
    }

    function animateBackground() {
        let livePoints = $('#live-background .live-point');

        if (livePoints.length === 0) return;

        $.each(livePoints, (ix, lp) => {
            moveLivePoint($(lp));
        })
    }

    function randomizeLivePoint(lp) {
        const directions = ['tl', 'tr', 'bl', 'br'];
        const sizes = [50, 75, 100, 125, 150];
        const speed = [1, 1.1, 1.2, 1.3, 1.4];

        const random_direction_ix = randomIntFromInterval(0, 3);
        const random_size_ix = randomIntFromInterval(0, 4);
        const random_speed_ix = randomIntFromInterval(0, 4);
        const random_pt = randomIntFromInterval(0, window.innerHeight - animationConfig.pointDiameter);
        const random_pl = randomIntFromInterval(0, window.innerWidth - animationConfig.pointDiameter);
        lp.addClass(`size-${sizes[random_size_ix]}`);
        lp.attr('data-speed', speed[random_speed_ix]);
        setLivePointPos(lp, random_pt, random_pl, directions[random_direction_ix]);
    }

    function moveLivePoint(lp) {
        let d = lp.attr('data-direction');
        let pt = parseInt(lp.attr('data-pt'));
        let pl = parseInt(lp.attr('data-pl'));
        let sp = parseFloat(lp.attr('data-speed'));
        let scaledMoveStep = animationConfig.moveStep * sp
        pt += d.startsWith("b") ? scaledMoveStep : -scaledMoveStep;
        pl += d.endsWith("r") ? scaledMoveStep : -scaledMoveStep;

        if (pt < -animationConfig.pointDiameter) {
            pt = -animationConfig.pointDiameter;
            d = d === "tl" ? "bl" : "br";
        } else if ((pt - animationConfig.pointDiameter) >= window.innerHeight) {
            pt = window.innerHeight;
            d = d === "bl" ? "tl" : "tr";
        }

        if (pl < -animationConfig.pointDiameter) {
            pl = -animationConfig.pointDiameter;
            d = d === "tl" ? "tr" : "br";
        } else if ((pl - animationConfig.pointDiameter) >= window.innerWidth) {
            pl = window.innerWidth;
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
