$(function () {
  $("#us2").locationpicker({
    location: { latitude: 10.347502193389849, longitude: 123.91937484572732 },
    radius: 0,
    inputBinding: {
      latitudeInput: $("#lat"),
      longitudeInput: $("#lng"),
      locationNameInput: $("#location"),
    },
    enableAutocomplete: true,
  });
});
