const OWN_BULLET = 1;
const ENEMY_BULLET = 2;
const BULLET_IMG = new Image()
BULLET_IMG.src = "pngwing.com.png"
var speedMultiplier = 1



class Bullet {
    constructor(x, y, type, speed, ctx) {
        this.x = x;
        this.y = y;
        this.type = type;
        this.ctx = ctx;
        this.speed = type==OWN_BULLET?speed:speed*speedMultiplier;
        this.width = 20;
        this.height = 40;
    }

    moveUp() {
        this.y -= this.speed;
    }

    moveDown() {
        this.y += this.speed;
    }

    draw() {
        if (this.type == OWN_BULLET) {
            this.ctx.fillStyle = 'rgb(255, 255, 255)';
            this.ctx.fillRect(
                this.x + this.width * 2,
                this.y,
                this.width,
                this.height
            );
        } else {
            this.ctx.drawImage(BULLET_IMG, this.x + this.width * 2, this.y - this.height*4, this.width*2, this.height*4)
        }
    }
}

class ShuttleGame {
    constructor() {
        let body = document.querySelector('body');
        this.canvas = document.querySelector('#canvas');
        this.message = 'Press  Enter  to  start!';

        this.shuttle = new Image();
        this.shuttle.src = 'shuttle.png';

        this.background = new Image();
        this.background.src = 'background.jpg';

        this.images = new Array();
        this.images.push(this.shuttle);
        this.images.push(this.background);

        this.speed = 30;
        this.playing = false;
        this.lastFiredBullet = null;

        this.prevPoints = 0;

        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;

        this.shuttleX = canvas.width / 2;
        this.shuttleY = canvas.height - 150;
        
        this.ctx = canvas.getContext('2d');
        
        let moveLeftAction = this.moveLeft.bind(this);
        let moveRightAction = this.moveRight.bind(this);
        let fireBulletAction = this.fireBullet.bind(this);
        let startAction = this.start.bind(this);


        body.addEventListener('keydown', function(event) {
            if (event.key == 'ArrowLeft') {
                moveLeftAction();
            } else if (event.key == 'ArrowRight') {
                moveRightAction();
            } else if (event.key == 'Enter') {
                startAction();
            }
            
            
        });
        body.addEventListener('keyup', (event)=>{
            if(event.key == 'f' && this.playing){
                let gunShotAudio = new Audio("audios/gunShot.mp3")
                gunShotAudio.play()
                fireBulletAction()
            }
        })

        let numImages = 0;
        let updateCall = this.update.bind(this);

        for (let image of this.images) {
            image.onload = function() {
                if (++numImages >= 2) {
                    setInterval(updateCall, 10);
                }
            }
        }
    }

    start() {
        if (this.playing) {
            return;
        }

        this.shuttleX = this.canvas.width / 2;
        this.shuttleY = this.canvas.height - 150;

        let generateEnemyBulletsCall = this.generateEnemyBullets.bind(this);
        
        if (this.enemyBulletsInterval) {
            clearInterval(this.enemyBulletsInterval);
        }
        
        this.enemyBulletsInterval = setInterval(generateEnemyBulletsCall, 2000);

        //let fireBulletCall = this.fireBullet.bind(this);
        
        // if (this.ownBulletsInterval) {
        //     clearInterval(this.ownBulletsInterval);
        // }
        
        //this.ownBulletsInterval = setInterval(fireBulletCall, 500);

        this.ownBullets = new Array();
        this.enemyBullets = new Array();

        this.playing = true;
        this.points = 0;

        this.showPoints();
    }

    showPoints() {
        if(this.points>this.prevPoints + 5){
            speedMultiplier+=1
            this.prevPoints = this.points
        }
        this.message = 'POINTS:  ' + this.points;
    }

    gameOver() {
        this.playing = false;
        this.message = 'GAME  OVER!!!';
    }

    update() {
        let ctx = this.ctx;

        var pattern = ctx.createPattern(this.background, 'repeat');
        ctx.fillStyle = pattern;
        ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        if (this.playing) {
            this.checkCollisions();
            this.cleanFiredBullets(this.ownBullets);

            for (let ownBullet of this.ownBullets) {
                ownBullet.moveUp();
                ownBullet.draw();
            }

            for (let enemyBullet of this.enemyBullets) {
                enemyBullet.moveDown();
                enemyBullet.draw();
            }
        } else {
            if (this.ownBullets) {
                for (let ownBullet of this.ownBullets) {
                    ownBullet.draw();
                }
            }

            if (this.enemyBullets) {
                for (let enemyBullet of this.enemyBullets) {
                    enemyBullet.draw();
                }
            }
        }

        /**
         * Adicionar los parámetros del método drawImage
         * para visualizar la imagen de la nave.
         * 15:00
         */

        ctx.drawImage(this.shuttle, this.shuttleX, this.shuttleY);

        ctx.fillStyle = 'white';
        ctx.font = '30pt Arcade';
        ctx.fillText(this.message, 30, 40);
        ctx.fillText("DIFFICULTY   LEVEL:   " + speedMultiplier, 30, 80);
        ctx.fillText("F   to   FIRE!!", 30, 120)
    }

    checkCollisions() {
        for (let enemyBullet of this.enemyBullets) {
            if ((Math.abs(this.shuttleX - enemyBullet.x) < 20 &&
                Math.abs(this.shuttleY - enemyBullet.y) < 20) || 
                (enemyBullet.y >= this.canvas.height - enemyBullet.height)) {
                let gameOverAudio = new Audio("audios/gameOver.wav")
                gameOverAudio.play()
                this.gameOver();
                return;
            }
        }

        for (let ownBullet of this.ownBullets) {
            let i = this.enemyBullets.length;

            while (i--) {
                let enemyBullet = this.enemyBullets[i];
                if (Math.abs(ownBullet.x - enemyBullet.x) < 20 &&
                    Math.abs(ownBullet.y - enemyBullet.y) < 20) {
                    this.points += 1;
                    this.enemyBullets.splice(i, 1);
                    this.showPoints();
                    break;
                }
            }
        }
    }

    cleanFiredBullets(bullets) {
        let i = bullets.length;

        while (i--) {
            let bullet = bullets[i];
            if (bullet.type == OWN_BULLET && bullet.y <= -bullet.height) {
                bullets.splice(i, 1);
            }
        }
    }

    moveLeft() {
        if (this.playing) {
            this.shuttleX -= this.speed;
        }
    }

    moveRight() {
        if (this.playing) {
            this.shuttleX += this.speed;
        }
    }

    fireBullet() {
        if (!this.playing) {
            return;
        }

        this.lastFiredBullet = new Bullet(this.shuttleX, this.shuttleY, OWN_BULLET, 10, this.ctx);
        this.ownBullets.push(this.lastFiredBullet);
    }

    generateEnemyBullets() {
        if (!this.playing) {
            return;
        }

        let enemyBullet = new Bullet((Math.random() * (this.canvas.width * 2 / 3) + this.canvas.width / 6) , 0, ENEMY_BULLET, 1, this.ctx);
        this.enemyBullets.push(enemyBullet);
    }
}

window.onload = function() {
    new ShuttleGame();
}
