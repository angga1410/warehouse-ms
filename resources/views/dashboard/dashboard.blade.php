@extends('layout.admin.base')

@section('body')
<style type="text/css">
:root {
  --color-off-white: 210, 30%, 97%;
  --color-purple: 208, 59.7%, 29.2%;
  --color-light-purple: 240, 52%, 94%;
  --color-orange: 13, 94%, 66%;
  --color-dark-orange: 13, 94%, 46%;
  --font-weight-normal: 400;
  --font-weight-medium: 600;
  --font-weight-bold: 700;
  --ease-out-quart: cubic-bezier(0.25, 1, 0.5, 1);
}
table.dataTable td {
  font-size: 1.6em;
}

html {
  box-sizing: border-box;
 
}
*,
*::before,
*::after {
  box-sizing: inherit;
}
body {
 
  color: HSL(var(--color-purple));
  background-color: HSL(var(--color-off-white));
  text-rendering: optimizeLegibility;
}
body,
input,
button {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
img {
  display: block;
  max-width: 100%;
}
.container {
  margin: 4rem auto;
  width: 170rem;
  padding: 0 4rem;
}
.dashboard {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  grid-template-rows: auto auto;
  grid-gap: 3rem;
}
.dashboard .booking-bar,
.dashboard .flights {
  grid-column: 1/10;
}
.dashboard .user-card,
.dashboard .sidebar {
  grid-column: 10/-1;
}
.dashboard .sidebar {
  align-self: start;
}
.dashboard .user-card {
  grid-row: 1/1;
}
input[type="text"],
input[type="search"],
input[type="email"],
input[type="phone"] {
  border-radius: 0.6rem;
  padding: 1em 1em;
  border: none;
  color: HSL(var(--color-purple));
}
.icon-input {
  position: relative;
}
.icon-input__icon {
  position: absolute;
  left: 0.5em;
  top: 50%;
  color: HSL(var(--color-purple));
  transform: translateY(-50%);
}
.icon-input input {
  padding-left: 3em;
}
.checkbox {
  position: absolute;
  left: -9999px;
  opacity: 0;
}
.checkbox + label {
  position: relative;
  font-size: 1.5rem;
  cursor: pointer;
}
.checkbox + label::before {
  border-radius: 0.8rem;
  content: '';
  display: inline-block;
  margin-right: 1rem;
  background-color: HSL(var(--color-light-blue));
  width: 2.5rem;
  height: 2.5rem;
  vertical-align: text-top;
  transition: 0.5s background-color var(--ease-out-quart);
}
.checkbox + label::after {
  display: inline-block;
  position: absolute;
  left: 0.6rem;
  top: 0.7rem;
  font-size: 1.2rem;
  font-family: 'Font Awesome 5 Pro';
  font-weight: 600;
  color: #fff;
  content: "\f00c";
  visibility: hidden;
}
.checkbox:hover + label::before {
  background-color: HSL(var(--color-purple));
}
.checkbox:checked + label::before {
  background-color: HSL(var(--color-purple));
}
.checkbox:checked + label::after {
  visibility: visible;
}
.button {
  border-radius: 0.8rem;
  padding: 0.75em 2em;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  background-color: HSL(var(--button-background-color, var(--color-orange)));
  color: HSL(var(--button-text-color, 0, 0%, 100%));
  font-size: 1.8rem;
  border: none;
  cursor: pointer;
  transition: background-color 0.7s var(--ease-out-quart), color 0.7s var(--ease-out-quart);
}
.button:hover {
  background-color: HSL(var(--button-hover-background-color, var(--color-dark-orange)));
  color: HSL(var(--button-hover-text-color, 0, 0%, 100%));
}
.button--purple {
  --button-background-color: var(--color-light-purple);
  --button-text-color: var(--color-purple);
  --button-hover-background-color: var(--color-purple);
}
.choice-list__item {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.choice-list__item:not(:last-child) {
  margin-bottom: 1rem;
}
.choice-list__aside {
  font-size: 1.4rem;
  color: red;
}
.styled-price {
  font-size: 4rem;
  font-weight: var(--font-weight-medium);
}
.styled-price sup {
  vertical-align: top;
  font-size: 1.5rem;
  font-weight: var(--font-weight-normal);
}
.styled-price sub {
  vertical-align: bottom;
  font-size: 1.2rem;
  font-weight: var(--font-weight-normal);
}
.route-line {
  position: relative;
  margin: 1rem 0 0;
  width: 100%;
  height: 1px;
  border: 0.1rem dashed HSL(var(--color-purple));
}
.route-line__stop {
  border-radius: 100%;
  box-sizing: content-box;
  width: 0.8rem;
  height: 0.8rem;
  position: absolute;
  top: 50%;
  background-color: HSL(var(--color-purple));
  transform: translate3d(-50%, -50%, 0);
}
.route-line__stop-name {
  margin-top: 1.5rem;
  font-size: 1.4rem;
  transform: translateX(-0.7rem);
}
.route-line__start {
  left: 0;
  border: 0.6rem solid HSL(var(--color-purple));
  background-color: #fff;
}
.route-line__end {
  right: 0;
  border: 0.6rem solid HSL(var(--color-light-purple));
  transform: translate3d(50%, -50%, 0);
}
.booking-bar {
  border-radius: 1.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 3rem;
  background-color: HSL(var(--color-purple));
  color: #fff;
}
.booking-bar__inputs {
  display: flex;
  align-items: center;
}
.booking-bar__inputs .icon-input:not(:last-of-type) {
  margin-right: 2rem;
}
.booking-bar__heading {
  margin-bottom: 0.8rem;
  font-size: 1.8rem;
  font-weight: var(--font-weight-medium);
  letter-spacing: 0.05rem;
}
.booking-bar__sub-heading {
  font-size: 1.4rem;
  letter-spacing: 0.05rem;
}
.user-card {
  border-radius: 1.5rem;
  box-shadow: 0 0 0.1rem HSLA(var(--color-purple), 0.1);
  display: flex;
  align-items: center;
  padding: 2rem;
  background-color: #fff;
}
.user-card__avatar {
  border-radius: 100%;
  overflow: hidden;
  margin-right: 2rem;
}
.user-card__heading {
  line-height: 1.25;
  font-size: 1.5rem;
}
.user-card__name {
  display: block;
  font-weight: 600;
}
.flights__total {
  margin-bottom: 1rem;
  font-weight: var(--font-weight-medium);
}
.flights__total span {
  font-size: 1.3rem;
}
.top-flights {
  display: flex;
  justify-content: space-between;
  margin-bottom: 3rem;
}
.top-flights .top-flight-card:not(:last-child) {
  margin-right: 2rem;
}
.top-flight-card {
  border-radius: 1.5rem;
  box-shadow: 0 0 0.1rem HSLA(var(--color-purple), 0.1);
  display: flex;
  padding: 2rem;
  background-color: #fff;
  cursor: pointer;
  transition: 0.6s var(--ease-out-quart);
}
.top-flight-card__price {
  margin-right: 1.5rem;
}
.top-flight-card__heading {
  margin-bottom: 0.4rem;
  font-weight: var(--font-weight-medium);
}
.top-flight-card__sub-heading {
  font-size: 1rem;
}
.top-flight-card.is-deactive,
.top-flight-card:hover {
  background-color: HSL(var(--color-orange));
  color: #fff;
}
.top-flight-card.is-active,
.top-flight-card:hover {
  background-color: HSL(var(--color-purple));
  color: #fff;
}


.flights-list__item:not(:last-child) {
  margin-bottom: 2.5rem;
}
.flight-card {
  border-radius: 1.5rem;
  box-shadow: 0 0 0.1rem HSLA(var(--color-purple), 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 3rem;
  background-color: #fff;
}
.flight-card__airline {
  border-radius: 100%;
  overflow: hidden;
  flex: 0 1 5rem;
  border: 0.2rem solid #fff;
}
.flight-card__airline + .flight-card__airline {
  position: relative;
  top: -1.5rem;
}
.flight-card__departure {
  margin-left: 2rem;
}
.flight-card__arrival {
  margin-right: 3rem;
  text-align: right;
}
.flight-card__route {
  display: flex;
  flex-direction: column;
  flex: 1 0 auto;
  justify-content: center;
  align-items: center;
  padding: 0 4rem;
}
.flight-card__duration,
.flight-card__type {
  font-size: 1.4rem;
}
.flight-card__type {
  margin-top: 1rem;
}
.flight-card__action {
  text-align: center;
}
.flight-card__time {
  display: inline-block;
  margin-bottom: 0.8rem;
  font-size: 2rem;
  font-weight: var(--font-weight-medium);
}
.flight-card__city {
  margin-bottom: 0.4rem;
  font-size: 1.8rem;
}
.flight-card__day {
  font-size: 1.4rem;
}
.flight-card__price {
  margin-bottom: 1rem;
}
.flight-card__cta {
  min-width: 16rem;
}
.sidebar {
  box-shadow: 0 0 0.1rem HSLA(var(--color-purple), 0.1);
  border-radius: 1.5rem;
  margin-top: 2.6rem;
  padding: 3rem 2rem;
  background-color: #fff;
}
.sidebar__action {
  width: 100%;
}
.sidebar-section:not(:last-child) {
  margin-bottom: 4rem;
}
.sidebar-section__heading {
  margin-bottom: 1.5rem;
  font-size: 2.2rem;
  font-weight: var(--font-weight-medium);
}

.time {
  color: #ddd;
  text-shadow: 0 1px 5px black;
  margin-top: 10%;
  font-size: 20px;
}

.hour {
  font-size: 80px;
}

.date {
  font-size: 25px;
}

.wrapper{
  padding: 4rem;
}

.table-responsive{
  height:700px; width:100%;
  overflow-y: auto;
  
}.table-responsive:hover{border-color:red;}


</style>
<div class="m-grid__item m-grid__item--fluid m-wrapper">

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<main>
<!-- <marquee style="font-size: 2em;" > No Message </marquee> -->
  <div class="wrapper">

    <section class="dashboard">
      <header class="booking-bar">
        <div class="booking-bar__info">
        <img src="{{url('/image/gspe3.png')}}" style="width: 70%;">
        <!-- <p><span style="font-size: 3em;">GSPE Warehouse</span></p> -->
        </div>
        <!-- /.booking-bar__info -->
        <div class="booking-bar__inputs">
        <p><span style="font-size: 3em;">{{date('d M Y ')}}</span></p>
 
   
        </div>
 
        <p><span style="font-size: 3em;"  id="clock"></span></p>
        <!-- booking-bar__inputs -->
      </header>

      <section class="flights">
        <header>
    
  
        </header>
        
    

      </section>
      <aside class="user-card">
        <!-- <figure class="user-card__avatar">
          <img src="//picsum.photos/50/50" alt="">
        </figure> -->
        <div class="p user-card__heading">
        <p><span style="font-size: 2em;">Warehouse Department</span></p>
        </div>
      </aside>

   
    </section>
    <!-- /.dashboard -->
  </div>
  <!-- /.container -->
</main>
</body>
         
</div>
      
@endsection 
@section('script')
<script>
var myVar = setInterval(function() {
  myTimer();
}, 1000);

function myTimer() {
  var d = new Date();
  document.getElementById("clock").innerHTML = d.toLocaleTimeString();
}

                    
</script>
@endsection