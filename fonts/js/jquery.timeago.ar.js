(function (factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof module === 'object' && typeof module.exports === 'object') {
    factory(require('jquery'));
  } else {
    factory(jQuery);
  }
}(function (jQuery) {
  function numpf(n, a) {
    return a[plural=n===0 ? 0 : n===1 ? 1 : n===2 ? 2 : n%100>=3 && n%100<=10 ? 3 : n%100>=11 ? 4 : 5];
  }
  
  jQuery.timeago.settings.strings = {
    prefixAgo: "منذ",
    prefixFromNow: "بعد",
    suffixAgo: null,
    suffixFromNow: null, // null OR "من الآن"
    second: function(value) { return numpf(value, [
      'أقل من ثانية',
       'ثانية واحدة تقريبا',
       'ثانيتين تقريبا',
       '%d ثوانٍ تقريبا',
       '%d ثانية تقريبا',
       '%d ثانية تقريبا']); },
    seconds: function(value) { return numpf(value, [
      'أقل من ثانية',
       'ثانية واحدة تقريبا',
       'ثانيتين تقريبا',
       '%d ثوانٍ تقريبا',
       '%d ثانية تقريبا',
       '%d ثانية تقريبا']); },
    minute: function(value) { return numpf(value, [
      'أقل من دقيقة',
       'دقيقة واحدة',
       'دقيقتين',
       '%d دقائق',
       '%d دقيقة',
       'دقيقة تقريبا']); },
    minutes: function(value) { return numpf(value, [
      'أقل من دقيقة',
       'دقيقة واحدة تقريبا',
       'دقيقتين تقريبا',
       '%d دقائق',
       '%d دقيقة تقريبا',
       'دقيقة تقريبا']); },
    hour:  function(value) { return numpf(value, [
      'أقل من ساعة',
       'ساعة واحدة تقريبا',
       'ساعتين تقريبا',
       '%d ساعات تقريبا',
       '%d ساعة تقريبا',
       '%d ساعة تقريبا']); },
    hours: function(value) { return numpf(value, [
      'أقل من ساعة',
       'ساعة واحدة تقريبا',
       'ساعتين تقريبا',
       '%d ساعات تقريبا',
       '%d ساعة تقريبا',
       '%d ساعة تقريبا']); },
    day:  function(value) { return numpf(value, [
      'أقل من يوم',
       'يوم واحد تقريبا',
       'يومين تقريبا',
       '%d أيام تقريبا',
       '%d يومًا تقريبا',
       '%d يوم تقريبا']); },
    days: function(value) { return numpf(value, [
      'أقل من يوم',
       'يوم واحد تقريبا',
       'يومين تقريبا',
       '%d أيام تقريبا',
       '%d يومًا تقريبا',
       '%d يوم تقريبا']); },
    month:  function(value) { return numpf(value, [
      'أقل من شهر',
       'شهر واحد تقريبا',
       'شهرين تقريبا',
       '%d أشهر تقريبا',
       '%d شهرًا تقريبا',
       '%d  شهر تقريبا']); },
    months: function(value) { return numpf(value, [
       ' أقل من شهر',
       'شهر واحد تقريبا',
       'شهرين تقريبا',
       '%d أشهر تقريبا',
       '%d شهرًا تقريبا',
       '%d شهر تقريبا']); },
    year:  function(value) { return numpf(value,  [
      'أقل من عام',
       'عام واحد تقريبا',
       '%d عامين تقريبا',
       '%d أعوام تقريبا',
       '%d عامًا تقريبا']);
     },
    years: function(value) { return numpf(value,  [
      'أقل من عام',
       'عام واحد تقريبا',
       'عامين تقريبا',
       '%d أعوام تقريبا',
       '%d عامًا تقريبا',
       '%d عام تقريبا']);}
  };
}));
