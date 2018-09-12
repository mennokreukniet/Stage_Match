<template>
  <div id="login">
      <div id="loading">
          <div class="dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
          </div>
        <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>  
        </div>
    </div>
      <input type="text" v-bind:placeholder="$t('email')">
      <input type="text" v-bind:placeholder="$t('password')">
      <button v-on:click="$i18n.locale === 'en' ? $i18n.locale = 'nl' : $i18n.locale = 'en'">{{$t('login')}}</button>
    
  </div>
</template>