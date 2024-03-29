import { LitElement, html, css } from 'lit-element';
import buttonStyles from '../assets/button-base.js';

class BookmarksLogin extends LitElement {
  static get properties() {
    return {
      url: { type: String }
    }
  }

  static get styles() {
    const mainCss = css`
      a {
        text-decoration: none;
      }
    `;
    return [buttonStyles, mainCss];
  }

  constructor() {
    super();
    this.url = 'https://archive.org/account/login';
  }
  render() {

    return html`
      <p>A free account is required to save and access bookmarks.</p>
      <a class="ia-button link primary" href="${this.url}">Log in</a>
    `;
  }
}

customElements.define('bookmarks-login', BookmarksLogin);
