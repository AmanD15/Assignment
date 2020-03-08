import { Component } from '@angular/core';
import {Details} from '../details';
import {HTTPService} from './http.service';
import { BreakpointObserver, Breakpoints } from '@angular/cdk/layout';
import { Observable } from 'rxjs';
import { map, shareReplay } from 'rxjs/operators';
import { MatTableDataSource } from '@angular/material/table';
import {MatLabel} from '@angular/material/form-field';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent {
  title = 'Assignment-TechHead';
  dataSource = new MatTableDataSource();
  displayedColumns: string[] = ['id', 'name', 'rollno'];

  constructor(
    private HttpService: HTTPService,
    private breakpointObserver: BreakpointObserver
  ) { }

  isHandset$: Observable<boolean> = this.breakpointObserver.observe(Breakpoints.Handset)
  .pipe(
    map(result => result.matches),
    shareReplay()
  );

  details: Details;
  
  ngOnInit () {
      this.HttpService.getDetails()
        .subscribe((data: any) => {this.details = data;
          this.dataSource.data = data} );   
  } 

  selectedDetail : Details 
  selectPerson(detail:Details): void{
    this.selectedDetail = detail;
  }

  // dataSource.filterPredicate = (data:
  //   {name: string}, filterValue: string) =>
  //   data.name.trim().toLowerCase().indexOf(filterValue) !== -1;

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

}