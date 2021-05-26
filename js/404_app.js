(function() {
    /* TODO: bounding ball*/
/*
    function easeOutBounce(x) {
        const n1 = 7.5625;
        const d1 = 2.75;

        if (x < 1 / d1) {
            return n1 * x * x;
        } else if (x < 2 / d1) {
            return n1 * (x -= 1.5 / d1) * x + 0.75;
        } else if (x < 2.5 / d1) {
            return n1 * (x -= 2.25 / d1) * x + 0.9375;
        } else {
            return n1 * (x -= 2.625 / d1) * x + 0.984375;
        }
    }
*/
    window.addEventListener('load', () => {

        let timeline = anime.timeline({
            targets: '#ball',
        });

        timeline
        .add({
            keyframes: [
                {bottom: ['100%','10%'], easing: 'easeInQuad'}
            ],
            delay: 0,
            duration: 625
        }, 500)
        .add({
            keyframes: [
                {bottom: ['10%','45%'], easing: 'easeOutQuad'},
                {bottom: '10%', easing: 'easeInQuad'}
            ],
            delay: 0,
            duration: 550
        })
        .add({
            keyframes: [
                {bottom: ['10%','30%'], easing: 'easeOutQuad'},
                {bottom: '10%', easing: 'easeInQuad'}
            ],
            duration: 450
        })
        .add({
            keyframes: [
                {bottom: ['10%','20%'], easing: 'easeOutQuad'},
                {bottom: '10%', easing: 'easeInQuad'}
            ],
            delay: 25,
            duration: 300
        })
        .add({
            keyframes: [
                {bottom: ['10%','15%'], easing: 'easeOutQuad'},
                {bottom: '10%', easing: 'easeInQuad'}
            ],
            delay: 50,
            duration: 200
        })
        .add({
            keyframes: [
                {bottom: ['10%','12.5%'], easing: 'easeOutQuad'},
                {bottom: '10%', easing: 'easeInQuad'}
            ],
            delay: 50,
            duration: 150
        })
        .add({
            keyframes: [
                {bottom: ['10%','11.75%'], easing: 'easeOutQuad'},
                {bottom: '10%', easing: 'easeInQuad'}
            ],
            delay: 50,
            duration: 100
        })
        .add({
            keyframes: [
                {bottom: ['10%','11%'], easing: 'easeOutQuad'},
                {bottom: '10%', easing: 'easeInQuad'}
            ],
            delay: 50,
            duration: 75
        })
        .add({
            keyframes: [
                {bottom: ['10%','10.5%'], easing: 'easeOutQuad'},
                {bottom: '10%', easing: 'easeInQuad'}
            ],
            delay: 50,
            duration: 50
        })
        .add({
            rotate: 720,
            easing: 'easeOutQuad',
            duration: 5000
        },500)
        .add({
            right: ['100% + 150px', '5%'],
            easing: 'easeOutQuad',
            duration: 5000,
        },500);

    });

})()