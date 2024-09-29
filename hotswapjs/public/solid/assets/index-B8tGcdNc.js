(function(){const t=document.createElement("link").relList;if(t&&t.supports&&t.supports("modulepreload"))return;for(const o of document.querySelectorAll('link[rel="modulepreload"]'))l(o);new MutationObserver(o=>{for(const n of o)if(n.type==="childList")for(const r of n.addedNodes)r.tagName==="LINK"&&r.rel==="modulepreload"&&l(r)}).observe(document,{childList:!0,subtree:!0});function s(o){const n={};return o.integrity&&(n.integrity=o.integrity),o.referrerPolicy&&(n.referrerPolicy=o.referrerPolicy),o.crossOrigin==="use-credentials"?n.credentials="include":o.crossOrigin==="anonymous"?n.credentials="omit":n.credentials="same-origin",n}function l(o){if(o.ep)return;o.ep=!0;const n=s(o);fetch(o.href,n)}})();const H=(e,t)=>e===t,U={equals:H};let z=V;const y=1,m=2,P={owned:null,cleanups:null,context:null,owner:null};var p=null;let $=null,K=null,c=null,a=null,g=null,v=0;function Q(e,t){const s=c,l=p,o=e.length===0,n=t===void 0?l:t,r=o?P:{owned:null,cleanups:null,context:n?n.context:null,owner:n},i=o?e:()=>e(()=>_(()=>w(r)));p=r,c=null;try{return S(i,!0)}finally{c=s,p=l}}function W(e,t){t=t?Object.assign({},U,t):U;const s={value:e,observers:null,observerSlots:null,comparator:t.equals||void 0},l=o=>(typeof o=="function"&&(o=o(s.value)),j(s,o));return[X.bind(s),l]}function O(e,t,s){const l=J(e,t,!1,y);N(l)}function _(e){if(c===null)return e();const t=c;c=null;try{return e()}finally{c=t}}function X(){if(this.sources&&this.state)if(this.state===y)N(this);else{const e=a;a=null,S(()=>x(this),!1),a=e}if(c){const e=this.observers?this.observers.length:0;c.sources?(c.sources.push(this),c.sourceSlots.push(e)):(c.sources=[this],c.sourceSlots=[e]),this.observers?(this.observers.push(c),this.observerSlots.push(c.sources.length-1)):(this.observers=[c],this.observerSlots=[c.sources.length-1])}return this.value}function j(e,t,s){let l=e.value;return(!e.comparator||!e.comparator(l,t))&&(e.value=t,e.observers&&e.observers.length&&S(()=>{for(let o=0;o<e.observers.length;o+=1){const n=e.observers[o],r=$&&$.running;r&&$.disposed.has(n),(r?!n.tState:!n.state)&&(n.pure?a.push(n):g.push(n),n.observers&&I(n)),r||(n.state=y)}if(a.length>1e6)throw a=[],new Error},!1)),t}function N(e){if(!e.fn)return;w(e);const t=v;k(e,e.value,t)}function k(e,t,s){let l;const o=p,n=c;c=p=e;try{l=e.fn(t)}catch(r){return e.pure&&(e.state=y,e.owned&&e.owned.forEach(w),e.owned=null),e.updatedAt=s+1,q(r)}finally{c=n,p=o}(!e.updatedAt||e.updatedAt<=s)&&(e.updatedAt!=null&&"observers"in e?j(e,l):e.value=l,e.updatedAt=s)}function J(e,t,s,l=y,o){const n={fn:e,state:l,updatedAt:null,owned:null,sources:null,sourceSlots:null,cleanups:null,value:t,owner:p,context:p?p.context:null,pure:s};return p===null||p!==P&&(p.owned?p.owned.push(n):p.owned=[n]),n}function D(e){if(e.state===0)return;if(e.state===m)return x(e);if(e.suspense&&_(e.suspense.inFallback))return e.suspense.effects.push(e);const t=[e];for(;(e=e.owner)&&(!e.updatedAt||e.updatedAt<v);)e.state&&t.push(e);for(let s=t.length-1;s>=0;s--)if(e=t[s],e.state===y)N(e);else if(e.state===m){const l=a;a=null,S(()=>x(e,t[0]),!1),a=l}}function S(e,t){if(a)return e();let s=!1;t||(a=[]),g?s=!0:g=[],v++;try{const l=e();return Y(s),l}catch(l){s||(g=null),a=null,q(l)}}function Y(e){if(a&&(V(a),a=null),e)return;const t=g;g=null,t.length&&S(()=>z(t),!1)}function V(e){for(let t=0;t<e.length;t++)D(e[t])}function x(e,t){e.state=0;for(let s=0;s<e.sources.length;s+=1){const l=e.sources[s];if(l.sources){const o=l.state;o===y?l!==t&&(!l.updatedAt||l.updatedAt<v)&&D(l):o===m&&x(l,t)}}}function I(e){for(let t=0;t<e.observers.length;t+=1){const s=e.observers[t];s.state||(s.state=m,s.pure?a.push(s):g.push(s),s.observers&&I(s))}}function w(e){let t;if(e.sources)for(;e.sources.length;){const s=e.sources.pop(),l=e.sourceSlots.pop(),o=s.observers;if(o&&o.length){const n=o.pop(),r=s.observerSlots.pop();l<o.length&&(n.sourceSlots[r]=l,o[l]=n,s.observerSlots[l]=r)}}if(e.tOwned){for(t=e.tOwned.length-1;t>=0;t--)w(e.tOwned[t]);delete e.tOwned}if(e.owned){for(t=e.owned.length-1;t>=0;t--)w(e.owned[t]);e.owned=null}if(e.cleanups){for(t=e.cleanups.length-1;t>=0;t--)e.cleanups[t]();e.cleanups=null}e.state=0}function Z(e){return e instanceof Error?e:new Error(typeof e=="string"?e:"Unknown error",{cause:e})}function q(e,t=p){throw Z(e)}function ee(e,t){return _(()=>e(t||{}))}function te(e,t,s){let l=s.length,o=t.length,n=l,r=0,i=0,f=t[o-1].nextSibling,u=null;for(;r<o||i<n;){if(t[r]===s[i]){r++,i++;continue}for(;t[o-1]===s[n-1];)o--,n--;if(o===r){const d=n<l?i?s[i-1].nextSibling:s[n-i]:f;for(;i<n;)e.insertBefore(s[i++],d)}else if(n===i)for(;r<o;)(!u||!u.has(t[r]))&&t[r].remove(),r++;else if(t[r]===s[n-1]&&s[i]===t[o-1]){const d=t[--o].nextSibling;e.insertBefore(s[i++],t[r++].nextSibling),e.insertBefore(s[--n],d),t[o]=s[n]}else{if(!u){u=new Map;let h=i;for(;h<n;)u.set(s[h],h++)}const d=u.get(t[r]);if(d!=null)if(i<d&&d<n){let h=r,E=1,L;for(;++h<o&&h<n&&!((L=u.get(t[h]))==null||L!==d+E);)E++;if(E>d-i){const R=t[r];for(;i<d;)e.insertBefore(s[i++],R)}else e.replaceChild(s[i++],t[r++])}else r++;else t[r++].remove()}}}const G="_$DX_DELEGATE";function se(e,t,s,l={}){let o;return Q(n=>{o=n,t===document?e():F(t,e(),t.firstChild?null:void 0,s)},l.owner),()=>{o(),t.textContent=""}}function C(e,t,s){let l;const o=()=>{const r=document.createElement("template");return r.innerHTML=e,r.content.firstChild},n=()=>(l||(l=o())).cloneNode(!0);return n.cloneNode=n,n}function oe(e,t=window.document){const s=t[G]||(t[G]=new Set);for(let l=0,o=e.length;l<o;l++){const n=e[l];s.has(n)||(s.add(n),t.addEventListener(n,le))}}function B(e,t,s){s==null?e.removeAttribute(t):e.setAttribute(t,s)}function F(e,t,s,l){if(s!==void 0&&!l&&(l=[]),typeof t!="function")return A(e,t,l,s);O(o=>A(e,t(),o,s),l)}function le(e){let t=e.target;const s=`$$${e.type}`,l=e.target,o=e.currentTarget,n=f=>Object.defineProperty(e,"target",{configurable:!0,value:f}),r=()=>{const f=t[s];if(f&&!t.disabled){const u=t[`${s}Data`];if(u!==void 0?f.call(t,u,e):f.call(t,e),e.cancelBubble)return}return t.host&&typeof t.host!="string"&&!t.host._$host&&t.contains(e.target)&&n(t.host),!0},i=()=>{for(;r()&&(t=t._$host||t.parentNode||t.host););};if(Object.defineProperty(e,"currentTarget",{configurable:!0,get(){return t||document}}),e.composedPath){const f=e.composedPath();n(f[0]);for(let u=0;u<f.length-2&&(t=f[u],!!r());u++){if(t._$host){t=t._$host,i();break}if(t.parentNode===o)break}}else i();n(l)}function A(e,t,s,l,o){for(;typeof s=="function";)s=s();if(t===s)return s;const n=typeof t,r=l!==void 0;if(e=r&&s[0]&&s[0].parentNode||e,n==="string"||n==="number"){if(n==="number"&&(t=t.toString(),t===s))return s;if(r){let i=s[0];i&&i.nodeType===3?i.data!==t&&(i.data=t):i=document.createTextNode(t),s=b(e,s,l,i)}else s!==""&&typeof s=="string"?s=e.firstChild.data=t:s=e.textContent=t}else if(t==null||n==="boolean")s=b(e,s,l);else{if(n==="function")return O(()=>{let i=t();for(;typeof i=="function";)i=i();s=A(e,i,s,l)}),()=>s;if(Array.isArray(t)){const i=[],f=s&&Array.isArray(s);if(T(i,t,s,o))return O(()=>s=A(e,i,s,l,!0)),()=>s;if(i.length===0){if(s=b(e,s,l),r)return s}else f?s.length===0?M(e,i,l):te(e,s,i):(s&&b(e),M(e,i));s=i}else if(t.nodeType){if(Array.isArray(s)){if(r)return s=b(e,s,l,t);b(e,s,null,t)}else s==null||s===""||!e.firstChild?e.appendChild(t):e.replaceChild(t,e.firstChild);s=t}}return s}function T(e,t,s,l){let o=!1;for(let n=0,r=t.length;n<r;n++){let i=t[n],f=s&&s[e.length],u;if(!(i==null||i===!0||i===!1))if((u=typeof i)=="object"&&i.nodeType)e.push(i);else if(Array.isArray(i))o=T(e,i,f)||o;else if(u==="function")if(l){for(;typeof i=="function";)i=i();o=T(e,Array.isArray(i)?i:[i],Array.isArray(f)?f:[f])||o}else e.push(i),o=!0;else{const d=String(i);f&&f.nodeType===3&&f.data===d?e.push(f):e.push(document.createTextNode(d))}}return o}function M(e,t,s=null){for(let l=0,o=t.length;l<o;l++)e.insertBefore(t[l],s)}function b(e,t,s,l){if(s===void 0)return e.textContent="";const o=l||document.createTextNode("");if(t.length){let n=!1;for(let r=t.length-1;r>=0;r--){const i=t[r];if(o!==i){const f=i.parentNode===e;!n&&!r?f?e.replaceChild(o,i):e.insertBefore(o,s):f&&i.remove()}else n=!0}}else e.insertBefore(o,s);return[o]}const ne="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20166%20155.3'%3e%3cpath%20d='M163%2035S110-4%2069%205l-3%201c-6%202-11%205-14%209l-2%203-15%2026%2026%205c11%207%2025%2010%2038%207l46%209%2018-30z'%20fill='%2376b3e1'/%3e%3clinearGradient%20id='a'%20gradientUnits='userSpaceOnUse'%20x1='27.5'%20y1='3'%20x2='152'%20y2='63.5'%3e%3cstop%20offset='.1'%20stop-color='%2376b3e1'/%3e%3cstop%20offset='.3'%20stop-color='%23dcf2fd'/%3e%3cstop%20offset='1'%20stop-color='%2376b3e1'/%3e%3c/linearGradient%3e%3cpath%20d='M163%2035S110-4%2069%205l-3%201c-6%202-11%205-14%209l-2%203-15%2026%2026%205c11%207%2025%2010%2038%207l46%209%2018-30z'%20opacity='.3'%20fill='url(%23a)'/%3e%3cpath%20d='M52%2035l-4%201c-17%205-22%2021-13%2035%2010%2013%2031%2020%2048%2015l62-21S92%2026%2052%2035z'%20fill='%23518ac8'/%3e%3clinearGradient%20id='b'%20gradientUnits='userSpaceOnUse'%20x1='95.8'%20y1='32.6'%20x2='74'%20y2='105.2'%3e%3cstop%20offset='0'%20stop-color='%2376b3e1'/%3e%3cstop%20offset='.5'%20stop-color='%234377bb'/%3e%3cstop%20offset='1'%20stop-color='%231f3b77'/%3e%3c/linearGradient%3e%3cpath%20d='M52%2035l-4%201c-17%205-22%2021-13%2035%2010%2013%2031%2020%2048%2015l62-21S92%2026%2052%2035z'%20opacity='.3'%20fill='url(%23b)'/%3e%3clinearGradient%20id='c'%20gradientUnits='userSpaceOnUse'%20x1='18.4'%20y1='64.2'%20x2='144.3'%20y2='149.8'%3e%3cstop%20offset='0'%20stop-color='%23315aa9'/%3e%3cstop%20offset='.5'%20stop-color='%23518ac8'/%3e%3cstop%20offset='1'%20stop-color='%23315aa9'/%3e%3c/linearGradient%3e%3cpath%20d='M134%2080a45%2045%200%2000-48-15L24%2085%204%20120l112%2019%2020-36c4-7%203-15-2-23z'%20fill='url(%23c)'/%3e%3clinearGradient%20id='d'%20gradientUnits='userSpaceOnUse'%20x1='75.2'%20y1='74.5'%20x2='24.4'%20y2='260.8'%3e%3cstop%20offset='0'%20stop-color='%234377bb'/%3e%3cstop%20offset='.5'%20stop-color='%231a336b'/%3e%3cstop%20offset='1'%20stop-color='%231a336b'/%3e%3c/linearGradient%3e%3cpath%20d='M114%20115a45%2045%200%2000-48-15L4%20120s53%2040%2094%2030l3-1c17-5%2023-21%2013-34z'%20fill='url(%23d)'/%3e%3c/svg%3e",ie="/solid/vite.svg";var re=C('<div><a href=https://vitejs.dev target=_blank><img class=logo alt="Vite logo"></a><a href=https://solidjs.com target=_blank><img class="logo solid"alt="Solid logo">'),fe=C("<h1>Vite + Solid"),ce=C("<div class=card><button>count is </button><p>Edit <code>src/App.tsx</code> and save to test HMR"),ue=C("<p class=read-the-docs>Click on the Vite and Solid logos to learn more");function ae(){const[e,t]=W(0);return[(()=>{var s=re(),l=s.firstChild,o=l.firstChild,n=l.nextSibling,r=n.firstChild;return B(o,"src",ie),B(r,"src",ne),s})(),fe(),(()=>{var s=ce(),l=s.firstChild;return l.firstChild,l.$$click=()=>t(o=>o+1),F(l,e,null),s})(),ue()]}oe(["click"]);const pe=document.getElementById("root");se(()=>ee(ae,{}),pe);
