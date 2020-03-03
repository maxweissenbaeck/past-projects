import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms'

@Component({
  selector: 'app-input',
  templateUrl: './input.component.html',
  styleUrls: ['./input.component.css']
})
export class InputComponent implements OnInit {
  inputValue: string = ""; //to control the value of input field
  outputValue: string = ""; //to control the value of bottom 'output' field
  numbers: Array<number> = []; //for list
  outputNumbers: Array<number> = []; //for bottom 'output' field
  //FormControl for Validation
  inputControl = new FormControl(this.numbers, [
    Validators.min(1),
    Validators.max(1000),
    //funktioniert leider nicht bei <input type="number" vermutlich da pattern auf Strings basiert
    Validators.pattern("^([1-9]|[1-9][0-9]|[1-9][0-9][0-9]|1000)$")
    ]);

  constructor() { }

  ngOnInit(): void {
  }

  /*
  * Adds random number to list/array
  */
  addRandomNumber() {
    let randomNumber = Math.floor(Math.random() * 1000) + 1;
    this.numbers.push(randomNumber);
    this.outputNumbers.push(randomNumber);
  }

  /*
  * Adds number from input to list/array
  */
  addNumber(newNumber: number) {
    this.numbers.push(newNumber);
    this.outputNumbers.push(newNumber);
    this.inputValue = null;
  }

  /*
  * Deletes all numbers from list/array
  */
  deleteNumbers() {
    this.numbers = [];
    this.outputNumbers = [];
    this.outputValue = "Output";
  }

  /*
  * Sorts numbers of list/array
  */
  sortNumbers() {
    this.numbers.sort((a, b) => a - b);
  }

  /*
  * Sorts numbers of list/array reversed
  */
  sortNumbersReversed() {
    this.numbers.sort((a, b) => b - a);
  }

  /*
  * Writes smallest number into bottom input field
  */
  smallestNumber() {
    this.outputNumbers.sort((a, b) => a - b);
    this.outputValue = this.outputNumbers[0].toString();
  }

  /*
  * Writes biggest number into bottom input field
  */
  biggestNumber() {
    this.outputNumbers.sort((a, b) => b - a);
    this.outputValue = this.outputNumbers[0].toString();
  }
}
