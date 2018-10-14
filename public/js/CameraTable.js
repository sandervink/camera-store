class CameraTable {
  constructor(tableType3, tableType5, tableType3And5, tableTypeOther) {
    this.tableType3 = tableType3;
    this.tableType5 = tableType5;
    this.tableType3And5 = tableType3And5;
    this.tableTypeOther = tableTypeOther;
  }

  _addRowsToTable(tableId, cameras) {
    const tableElement = document.getElementById(tableId);
    if (tableElement !== null) {
      cameras.forEach(camera => {
        const row = tableElement.tBodies[0].insertRow();
        row.insertCell(0).innerText = camera.number;
        row.insertCell(1).innerText = camera.name;
        row.insertCell(2).innerText = camera.latitude;
        row.insertCell(3).innerText = camera.longitude;
      });
    }
  }

  populateCameraTable(cameraData) {
    const camerasType3 = [];
    const camerasType5 = [];
    const camerasType3And5 = [];
    const camerasTypeOther = [];

    cameraData.cameras.forEach(camera => {
      // Can be divided by 3
      if (camera.number % 3 === 0) {
        camerasType3.push(camera);
      }

      // Can be divided by 5
      if (camera.number % 5 === 0) {
        camerasType5.push(camera);
      }

      // Can be divided by both 3 and 5
      if (camera.number % 3 === 0 && camera.number % 5 === 0) {
        camerasType3And5.push(camera);
      }

      // Cannot be divided by 3 nor by 5
      if (camera.number % 3 !== 0 && camera.number % 5 !== 0) {
        camerasTypeOther.push(camera);
      }
    });

    this._addRowsToTable(this.tableType3, camerasType3);
    this._addRowsToTable(this.tableType5, camerasType5);
    this._addRowsToTable(this.tableType3And5, camerasType3And5);
    this._addRowsToTable(this.tableTypeOther, camerasTypeOther);
  };
}