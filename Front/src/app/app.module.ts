import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { ArticleComponent } from './article/article.component';
import { FormeComponent } from './article/forme/forme.component';
import { ListeComponent } from './article/liste/liste.component';
import { ItemComponent } from './article/liste/item/item.component';


@NgModule({
  declarations: [
    AppComponent,
    ArticleComponent,
    FormeComponent,
    ListeComponent,
    ItemComponent,
   
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
