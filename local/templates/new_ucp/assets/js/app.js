(() => {
    "use strict";
    function isWebp() {
        function testWebP(callback) {
            let webP = new Image;
            webP.onload = webP.onerror = function() {
                callback(webP.height == 2);
            };
            webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
        }
        testWebP(function(support) {
            let className = support === true ? "webp" : "no-webp";
            document.documentElement.classList.add(className);
        });
    }
    let isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows();
        }
    };
    function addTouchClass() {
        if (isMobile.any()) document.documentElement.classList.add("touch");
    }
    function addLoadedClass() {
        if (!document.documentElement.classList.contains("loading")) window.addEventListener("load", function() {
            setTimeout(function() {
                document.documentElement.classList.add("loaded");
            }, 0);
        });
    }
    let _slideUp = (target, duration = 500, showmore = 0) => {
        if (!target.classList.contains("_slide")) {
            target.classList.add("_slide");
            target.style.transitionProperty = "height, margin, padding";
            target.style.transitionDuration = duration + "ms";
            target.style.height = `${target.offsetHeight}px`;
            target.offsetHeight;
            target.style.overflow = "hidden";
            target.style.height = showmore ? `${showmore}px` : `0px`;
            target.style.paddingTop = 0;
            target.style.paddingBottom = 0;
            target.style.marginTop = 0;
            target.style.marginBottom = 0;
            window.setTimeout(() => {
                target.hidden = !showmore ? true : false;
                !showmore ? target.style.removeProperty("height") : null;
                target.style.removeProperty("padding-top");
                target.style.removeProperty("padding-bottom");
                target.style.removeProperty("margin-top");
                target.style.removeProperty("margin-bottom");
                !showmore ? target.style.removeProperty("overflow") : null;
                target.style.removeProperty("transition-duration");
                target.style.removeProperty("transition-property");
                target.classList.remove("_slide");
                document.dispatchEvent(new CustomEvent("slideUpDone", {
                    detail: {
                        target
                    }
                }));
            }, duration);
        }
    };
    let _slideDown = (target, duration = 500, showmore = 0) => {
        if (!target.classList.contains("_slide")) {
            target.classList.add("_slide");
            target.hidden = target.hidden ? false : null;
            showmore ? target.style.removeProperty("height") : null;
            let height = target.offsetHeight;
            target.style.overflow = "hidden";
            target.style.height = showmore ? `${showmore}px` : `0px`;
            target.style.paddingTop = 0;
            target.style.paddingBottom = 0;
            target.style.marginTop = 0;
            target.style.marginBottom = 0;
            target.offsetHeight;
            target.style.transitionProperty = "height, margin, padding";
            target.style.transitionDuration = duration + "ms";
            target.style.height = height + "px";
            target.style.removeProperty("padding-top");
            target.style.removeProperty("padding-bottom");
            target.style.removeProperty("margin-top");
            target.style.removeProperty("margin-bottom");
            window.setTimeout(() => {
                target.style.removeProperty("height");
                target.style.removeProperty("overflow");
                target.style.removeProperty("transition-duration");
                target.style.removeProperty("transition-property");
                target.classList.remove("_slide");
                document.dispatchEvent(new CustomEvent("slideDownDone", {
                    detail: {
                        target
                    }
                }));
            }, duration);
        }
    };
    let _slideToggle = (target, duration = 500) => {
        if (target.hidden) return _slideDown(target, duration); else return _slideUp(target, duration);
    };
    let bodyLockStatus = true;
    let bodyLockToggle = (delay = 500) => {
        if (document.documentElement.classList.contains("lock")) bodyUnlock(delay); else bodyLock(delay);
    };
    let bodyUnlock = (delay = 500) => {
        if (bodyLockStatus) {
            const lockPaddingElements = document.querySelectorAll("[data-lp]");
            setTimeout(() => {
                lockPaddingElements.forEach(lockPaddingElement => {
                    lockPaddingElement.style.paddingRight = "";
                });
                document.body.style.paddingRight = "";
                document.documentElement.classList.remove("lock");
            }, delay);
            bodyLockStatus = false;
            setTimeout(function() {
                bodyLockStatus = true;
            }, delay);
        }
    };
    let bodyLock = (delay = 500) => {
        if (bodyLockStatus) {
            const lockPaddingElements = document.querySelectorAll("[data-lp]");
            const lockPaddingValue = window.innerWidth - document.body.offsetWidth + "px";
            lockPaddingElements.forEach(lockPaddingElement => {
                lockPaddingElement.style.paddingRight = lockPaddingValue;
            });
            document.body.style.paddingRight = lockPaddingValue;
            document.documentElement.classList.add("lock");
            bodyLockStatus = false;
            setTimeout(function() {
                bodyLockStatus = true;
            }, delay);
        }
    };
    function spollers() {
        if (typeof document === "undefined" || !document) return;
        const spollersArray = document.querySelectorAll("[data-spollers]");
        if (spollersArray.length > 0) {
            document.addEventListener("click", setSpollerAction);
            const spollersRegular = Array.from(spollersArray).filter(function(item, index, self) {
                return !item.dataset.spollers.split(",")[0];
            });
            if (spollersRegular.length) initSpollers(spollersRegular);
            let mdQueriesArray = dataMediaQueries(spollersArray, "spollers");
            if (mdQueriesArray && mdQueriesArray.length) mdQueriesArray.forEach(mdQueriesItem => {
                mdQueriesItem.matchMedia.addEventListener("change", function() {
                    initSpollers(mdQueriesItem.itemsArray, mdQueriesItem.matchMedia);
                });
                initSpollers(mdQueriesItem.itemsArray, mdQueriesItem.matchMedia);
            });
            function initSpollers(spollersArray, matchMedia = false) {
                spollersArray.forEach(spollersBlock => {
                    spollersBlock = matchMedia ? spollersBlock.item : spollersBlock;
                    if (matchMedia.matches || !matchMedia) {
                        spollersBlock.classList.add("_spoller-init");
                        initSpollerBody(spollersBlock);
                    } else {
                        spollersBlock.classList.remove("_spoller-init");
                        initSpollerBody(spollersBlock, false);
                    }
                });
            }
            function initSpollerBody(spollersBlock, hideSpollerBody = true) {
                let spollerItems = spollersBlock.querySelectorAll("details");
                if (spollerItems.length) spollerItems.forEach(spollerItem => {
                    let spollerTitle = spollerItem.querySelector("summary");
                    if (hideSpollerBody) {
                        spollerTitle.removeAttribute("tabindex");
                        if (!spollerItem.hasAttribute("data-open")) {
                            spollerItem.open = false;
                            spollerTitle.nextElementSibling.hidden = true;
                        } else {
                            spollerTitle.classList.add("_spoller-active");
                            spollerItem.open = true;
                        }
                    } else {
                        spollerTitle.setAttribute("tabindex", "-1");
                        spollerTitle.classList.remove("_spoller-active");
                        spollerItem.open = true;
                        spollerTitle.nextElementSibling.hidden = false;
                    }
                });
            }
            function setSpollerAction(e) {
                const el = e.target;
                const link = el.closest("a.spoller-link");
                const summary = el.closest("summary");
                if (link) {
                    e.preventDefault();
                    e.stopPropagation();
                    handleLinkClick(link);
                    return;
                }
                if (!summary) {
                    handleCloseOutsideSpoller(e);
                    return;
                }
                const spollerBlock = summary.closest("details");
                if (!spollerBlock) return;
                const spollersBlock = findParentSpollers(spollerBlock);
                if (!spollersBlock) return;
                e.preventDefault();
                if (spollersBlock.classList.contains("_spoller-init")) {
                    const spollerTitle = summary;
                    const oneSpoller = spollersBlock.hasAttribute("data-one-spoller");
                    const scrollSpoller = spollerBlock.hasAttribute("data-spoller-scroll");
                    const spollerSpeed = spollersBlock.dataset.spollersSpeed ? parseInt(spollersBlock.dataset.spollersSpeed) : 500;
                    if (!spollersBlock.querySelectorAll("._slide").length) {
                        if (oneSpoller && !spollerBlock.open) hideSpollersBody(spollersBlock, spollerBlock);
                        !spollerBlock.open ? spollerBlock.open = true : setTimeout(() => {
                            spollerBlock.open = false;
                        }, spollerSpeed);
                        spollerTitle.classList.toggle("_spoller-active");
                        _slideToggle(spollerTitle.nextElementSibling, spollerSpeed);
                        if (scrollSpoller && spollerTitle.classList.contains("_spoller-active")) {
                            const scrollSpollerValue = spollerBlock.dataset.spollerScroll;
                            const scrollSpollerOffset = +scrollSpollerValue ? +scrollSpollerValue : 0;
                            const scrollSpollerNoHeader = spollerBlock.hasAttribute("data-spoller-scroll-noheader") ? document.querySelector(".header").offsetHeight : 0;
                            window.scrollTo({
                                top: spollerBlock.offsetTop - (scrollSpollerOffset + scrollSpollerNoHeader),
                                behavior: "smooth"
                            });
                        }
                    }
                }
            }
            function handleLinkClick(link) {
                const checkboxId = link.dataset.checkbox;
                const parentId = link.dataset.parent || null;
                if (!checkboxId) return;
                const isChecked = link.classList.contains("checked");
                if (isChecked) link.classList.remove("checked"); else link.classList.add("checked");
                if (parentId) updateParentState(parentId);
                if (checkboxId.includes("_parent")) updateChildrenState(checkboxId);
            }
            function updateParentState(parentId) {
                const childLinks = document.querySelectorAll(`.spoller-link[data-parent="${parentId}"]`);
                const parentLink = document.querySelector(`.spoller-link[data-checkbox="${parentId}"]`);
                if (!parentLink || childLinks.length === 0) return;
                const checkedChildren = document.querySelectorAll(`.spoller-link[data-parent="${parentId}"].checked`);
                if (checkedChildren.length === childLinks.length) {
                    parentLink.classList.add("checked");
                    parentLink.classList.remove("indeterminate");
                } else if (checkedChildren.length > 0) {
                    parentLink.classList.add("indeterminate");
                    parentLink.classList.remove("checked");
                } else parentLink.classList.remove("checked", "indeterminate");
            }
            function updateChildrenState(parentId) {
                const parentLink = document.querySelector(`.spoller-link[data-checkbox="${parentId}"]`);
                if (!parentLink) return;
                const isChecked = parentLink.classList.contains("checked");
                const childLinks = document.querySelectorAll(`.spoller-link[data-parent="${parentId}"]`);
                childLinks.forEach(child => {
                    if (isChecked) child.classList.add("checked"); else child.classList.remove("checked");
                });
            }
            function findParentSpollers(detailsElement) {
                let parent = detailsElement.parentElement;
                while (parent) {
                    if (parent.hasAttribute("data-spollers")) return parent;
                    parent = parent.parentElement;
                }
                return null;
            }
            function handleCloseOutsideSpoller(e) {
                const el = e.target;
                if (!el.closest("[data-spollers]")) {
                    const spollersClose = document.querySelectorAll("[data-spoller-close]");
                    if (spollersClose.length) spollersClose.forEach(spollerClose => {
                        const spollersBlock = findParentSpollers(spollerClose.parentNode);
                        const spollerCloseBlock = spollerClose.parentNode;
                        if (spollersBlock && spollersBlock.classList.contains("_spoller-init")) {
                            const spollerSpeed = spollersBlock.dataset.spollersSpeed ? parseInt(spollersBlock.dataset.spollersSpeed) : 500;
                            spollerClose.classList.remove("_spoller-active");
                            _slideUp(spollerClose.nextElementSibling, spollerSpeed);
                            setTimeout(() => {
                                spollerCloseBlock.open = false;
                            }, spollerSpeed);
                        }
                    });
                }
            }
            function hideSpollersBody(spollersBlock, exceptBlock = null) {
                const spollerActiveBlocks = spollersBlock.querySelectorAll(":scope > details[open]");
                spollerActiveBlocks.forEach(spollerActiveBlock => {
                    if (exceptBlock && spollerActiveBlock === exceptBlock) return;
                    const parentDetails = spollerActiveBlock.closest("details");
                    if (parentDetails && parentDetails !== spollersBlock) return;
                    if (!spollersBlock.querySelectorAll("._slide").length) {
                        const spollerActiveTitle = spollerActiveBlock.querySelector("summary");
                        const spollerSpeed = spollersBlock.dataset.spollersSpeed ? parseInt(spollersBlock.dataset.spollersSpeed) : 500;
                        if (spollerActiveTitle) {
                            spollerActiveTitle.classList.remove("_spoller-active");
                            _slideUp(spollerActiveTitle.nextElementSibling, spollerSpeed);
                            setTimeout(() => {
                                spollerActiveBlock.open = false;
                            }, spollerSpeed);
                        }
                    }
                });
                if (spollersBlock.hasAttribute("data-one-spoller-global")) {
                    const allOpenDetails = spollersBlock.querySelectorAll("details[open]");
                    allOpenDetails.forEach(details => {
                        if (!exceptBlock || details !== exceptBlock) {
                            const title = details.querySelector("summary");
                            if (title) {
                                const speed = spollersBlock.dataset.spollersSpeed ? parseInt(spollersBlock.dataset.spollersSpeed) : 500;
                                title.classList.remove("_spoller-active");
                                _slideUp(title.nextElementSibling, speed);
                                setTimeout(() => {
                                    details.open = false;
                                }, speed);
                            }
                        }
                    });
                }
            }
        }
    }
    function menuInit() {
        if (document.querySelector(".icon-menu")) document.addEventListener("click", function(e) {
            if (bodyLockStatus && e.target.closest(".icon-menu")) {
                bodyLockToggle();
                document.documentElement.classList.toggle("menu-open");
            }
        });
    }
    function FLS(message) {
        setTimeout(() => {
            if (window.FLS) ;
        }, 0);
    }
    function getDigFormat(item, sepp = " ") {
        return item.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, `$1${sepp}`);
    }
    function uniqArray(array) {
        return array.filter(function(item, index, self) {
            return self.indexOf(item) === index;
        });
    }
    function dataMediaQueries(array, dataSetValue) {
        const media = Array.from(array).filter(function(item, index, self) {
            if (item.dataset[dataSetValue]) return item.dataset[dataSetValue].split(",")[0];
        });
        if (media.length) {
            const breakpointsArray = [];
            media.forEach(item => {
                const params = item.dataset[dataSetValue];
                const breakpoint = {};
                const paramsArray = params.split(",");
                breakpoint.value = paramsArray[0];
                breakpoint.type = paramsArray[1] ? paramsArray[1].trim() : "max";
                breakpoint.item = item;
                breakpointsArray.push(breakpoint);
            });
            let mdQueries = breakpointsArray.map(function(item) {
                return "(" + item.type + "-width: " + item.value + "px)," + item.value + "," + item.type;
            });
            mdQueries = uniqArray(mdQueries);
            const mdQueriesArray = [];
            if (mdQueries.length) {
                mdQueries.forEach(breakpoint => {
                    const paramsArray = breakpoint.split(",");
                    const mediaBreakpoint = paramsArray[1];
                    const mediaType = paramsArray[2];
                    const matchMedia = window.matchMedia(paramsArray[0]);
                    const itemsArray = breakpointsArray.filter(function(item) {
                        if (item.value === mediaBreakpoint && item.type === mediaType) return true;
                    });
                    mdQueriesArray.push({
                        itemsArray,
                        matchMedia
                    });
                });
                return mdQueriesArray;
            }
        }
    }
    const flsModules = {};
    function formFieldsInit(options = {
        viewPass: false,
        autoHeight: false
    }) {
        document.body.addEventListener("focusin", function(e) {
            const targetElement = e.target;
            if (targetElement.tagName === "INPUT" || targetElement.tagName === "TEXTAREA") {
                if (!targetElement.hasAttribute("data-no-focus-classes")) {
                    targetElement.classList.add("_form-focus");
                    targetElement.parentElement.classList.add("_form-focus");
                }
                formValidate.removeError(targetElement);
                targetElement.hasAttribute("data-validate") ? formValidate.removeError(targetElement) : null;
            }
        });
        document.body.addEventListener("focusout", function(e) {
            const targetElement = e.target;
            if (targetElement.tagName === "INPUT" || targetElement.tagName === "TEXTAREA") {
                if (!targetElement.hasAttribute("data-no-focus-classes")) {
                    targetElement.classList.remove("_form-focus");
                    targetElement.parentElement.classList.remove("_form-focus");
                }
                targetElement.hasAttribute("data-validate") ? formValidate.validateInput(targetElement) : null;
            }
        });
        if (options.viewPass) document.addEventListener("click", function(e) {
            let targetElement = e.target;
            if (targetElement.closest('[class*="__viewpass"]')) {
                let inputType = targetElement.classList.contains("_viewpass-active") ? "password" : "text";
                targetElement.parentElement.querySelector("input").setAttribute("type", inputType);
                targetElement.classList.toggle("_viewpass-active");
            }
        });
        if (options.autoHeight) {
            const textareas = document.querySelectorAll("textarea[data-autoheight]");
            if (textareas.length) {
                textareas.forEach(textarea => {
                    const startHeight = textarea.hasAttribute("data-autoheight-min") ? Number(textarea.dataset.autoheightMin) : Number(textarea.offsetHeight);
                    const maxHeight = textarea.hasAttribute("data-autoheight-max") ? Number(textarea.dataset.autoheightMax) : 1 / 0;
                    setHeight(textarea, Math.min(startHeight, maxHeight));
                    textarea.addEventListener("input", () => {
                        if (textarea.scrollHeight > startHeight) {
                            textarea.style.height = `auto`;
                            setHeight(textarea, Math.min(Math.max(textarea.scrollHeight, startHeight), maxHeight));
                        }
                    });
                });
                function setHeight(textarea, height) {
                    textarea.style.height = `${height}px`;
                }
            }
        }
    }
    let formValidate = {
        getErrors(form) {
            let error = 0;
            let formRequiredItems = form.querySelectorAll("*[data-required]");
            if (formRequiredItems.length) formRequiredItems.forEach(formRequiredItem => {
                if ((formRequiredItem.offsetParent !== null || formRequiredItem.tagName === "SELECT") && !formRequiredItem.disabled) error += this.validateInput(formRequiredItem);
            });
            return error;
        },
        validateInput(formRequiredItem) {
            let error = 0;
            if (formRequiredItem.dataset.required === "email") {
                formRequiredItem.value = formRequiredItem.value.replace(" ", "");
                if (this.emailTest(formRequiredItem)) {
                    this.addError(formRequiredItem);
                    this.removeSuccess(formRequiredItem);
                    error++;
                } else {
                    this.removeError(formRequiredItem);
                    this.addSuccess(formRequiredItem);
                }
            } else if (formRequiredItem.type === "checkbox" && !formRequiredItem.checked) {
                this.addError(formRequiredItem);
                this.removeSuccess(formRequiredItem);
                error++;
            } else if (!formRequiredItem.value.trim()) {
                this.addError(formRequiredItem);
                this.removeSuccess(formRequiredItem);
                error++;
            } else {
                this.removeError(formRequiredItem);
                this.addSuccess(formRequiredItem);
            }
            return error;
        },
        addError(formRequiredItem) {
            formRequiredItem.classList.add("_form-error");
            formRequiredItem.parentElement.classList.add("_form-error");
            let inputError = formRequiredItem.parentElement.querySelector(".form__error");
            if (inputError) formRequiredItem.parentElement.removeChild(inputError);
            if (formRequiredItem.dataset.error) formRequiredItem.parentElement.insertAdjacentHTML("beforeend", `<div class="form__error">${formRequiredItem.dataset.error}</div>`);
        },
        removeError(formRequiredItem) {
            formRequiredItem.classList.remove("_form-error");
            formRequiredItem.parentElement.classList.remove("_form-error");
            if (formRequiredItem.parentElement.querySelector(".form__error")) formRequiredItem.parentElement.removeChild(formRequiredItem.parentElement.querySelector(".form__error"));
        },
        addSuccess(formRequiredItem) {
            formRequiredItem.classList.add("_form-success");
            formRequiredItem.parentElement.classList.add("_form-success");
        },
        removeSuccess(formRequiredItem) {
            formRequiredItem.classList.remove("_form-success");
            formRequiredItem.parentElement.classList.remove("_form-success");
        },
        formClean(form) {
            form.reset();
            setTimeout(() => {
                let inputs = form.querySelectorAll("input,textarea");
                for (let index = 0; index < inputs.length; index++) {
                    const el = inputs[index];
                    el.parentElement.classList.remove("_form-focus");
                    el.classList.remove("_form-focus");
                    formValidate.removeError(el);
                }
                let checkboxes = form.querySelectorAll(".checkbox__input");
                if (checkboxes.length > 0) for (let index = 0; index < checkboxes.length; index++) {
                    const checkbox = checkboxes[index];
                    checkbox.checked = false;
                }
                if (flsModules.select) {
                    let selects = form.querySelectorAll("div.select");
                    if (selects.length) for (let index = 0; index < selects.length; index++) {
                        const select = selects[index].querySelector("select");
                        flsModules.select.selectBuild(select);
                    }
                }
            }, 0);
        },
        emailTest(formRequiredItem) {
            return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(formRequiredItem.value);
        }
    };
    let addWindowScrollEvent = false;
    function digitsCounter() {
        function digitsCountersInit(digitsCountersItems) {
            let digitsCounters = digitsCountersItems ? digitsCountersItems : document.querySelectorAll("[data-digits-counter]");
            if (digitsCounters.length) digitsCounters.forEach(digitsCounter => {
                if (digitsCounter.hasAttribute("data-go")) return;
                digitsCounter.setAttribute("data-go", "");
                digitsCounter.dataset.digitsCounter = digitsCounter.innerHTML;
                digitsCounter.innerHTML = `0`;
                digitsCountersAnimate(digitsCounter);
            });
        }
        function digitsCountersAnimate(digitsCounter) {
            let startTimestamp = null;
            const duration = parseFloat(digitsCounter.dataset.digitsCounterSpeed) ? parseFloat(digitsCounter.dataset.digitsCounterSpeed) : 2500;
            const startValue = parseFloat(digitsCounter.dataset.digitsCounter);
            const format = digitsCounter.dataset.digitsCounterFormat ? digitsCounter.dataset.digitsCounterFormat : " ";
            const startPosition = 0;
            const step = timestamp => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (startPosition + startValue));
                digitsCounter.innerHTML = typeof digitsCounter.dataset.digitsCounterFormat !== "undefined" ? getDigFormat(value, format) : value;
                if (progress < 1) window.requestAnimationFrame(step); else digitsCounter.removeAttribute("data-go");
            };
            window.requestAnimationFrame(step);
        }
        function digitsCounterAction(e) {
            const entry = e.detail.entry;
            const targetElement = entry.target;
            if (targetElement.querySelectorAll("[data-digits-counter]").length) digitsCountersInit(targetElement.querySelectorAll("[data-digits-counter]"));
        }
        document.addEventListener("watcherCallback", digitsCounterAction);
    }
    setTimeout(() => {
        if (addWindowScrollEvent) {
            let windowScroll = new Event("windowScroll");
            window.addEventListener("scroll", function(e) {
                document.dispatchEvent(windowScroll);
            });
        }
    }, 0);
    function classesToTokens(classes = "") {
        return classes.trim().split(" ").filter(c => !!c.trim());
    }
    function deleteProps(obj) {
        Object.keys(obj).forEach(key => {
            try {
                obj[key] = null;
            } catch {}
            try {
                delete obj[key];
            } catch {}
        });
    }
    function nextTick(callback, delay = 0) {
        return setTimeout(callback, delay);
    }
    function now() {
        return Date.now();
    }
    function utils_getComputedStyle(el) {
        return window.getComputedStyle(el, null);
    }
    function getTranslate(el, axis = "x") {
        const style = utils_getComputedStyle(el);
        const transform = style.transform || style.webkitTransform;
        if (!transform || transform === "none") return 0;
        const matrix = new DOMMatrixReadOnly(transform);
        return axis === "x" ? matrix.m41 : matrix.m42;
    }
    function isObject(o) {
        return typeof o === "object" && o !== null && !!o.constructor && Object.prototype.toString.call(o).slice(8, -1) === "Object";
    }
    function isNode(node) {
        if (typeof HTMLElement !== "undefined" && node instanceof HTMLElement) return true;
        return !!node && typeof node === "object" && (node.nodeType === 1 || node.nodeType === 11);
    }
    function extend(target, ...sources) {
        const to = Object(target);
        for (let i = 0; i < sources.length; i += 1) {
            const nextSource = sources[i];
            if (nextSource === void 0 || nextSource === null || isNode(nextSource)) continue;
            const sourceObj = nextSource;
            const keysArray = Object.keys(Object(sourceObj)).filter(key => key !== "__proto__" && key !== "constructor" && key !== "prototype");
            for (const nextKey of keysArray) {
                const desc = Object.getOwnPropertyDescriptor(sourceObj, nextKey);
                if (!desc || !desc.enumerable) continue;
                const sourceVal = sourceObj[nextKey];
                if (isObject(to[nextKey]) && isObject(sourceVal)) if (sourceVal.__swiper__) to[nextKey] = sourceVal; else extend(to[nextKey], sourceVal); else if (!isObject(to[nextKey]) && isObject(sourceVal)) {
                    to[nextKey] = {};
                    if (sourceVal.__swiper__) to[nextKey] = sourceVal; else extend(to[nextKey], sourceVal);
                } else to[nextKey] = sourceVal;
            }
        }
        return to;
    }
    function setCSSProperty(el, varName, varValue) {
        el.style.setProperty(varName, varValue);
    }
    function elementChildren(element, selector = "") {
        const children = [ ...element.children ];
        if (element instanceof HTMLSlotElement) children.push(...element.assignedElements());
        return selector ? children.filter(el => el.matches(selector)) : children;
    }
    function elementIsChildOfSlot(el, slot) {
        const queue = [ slot ];
        while (queue.length > 0) {
            const cur = queue.shift();
            if (el === cur) return true;
            queue.push(...cur.children, ...cur.shadowRoot ? cur.shadowRoot.children : [], ...cur.assignedElements ? cur.assignedElements() : []);
        }
        return false;
    }
    function elementIsChildOf(el, parent) {
        let isChild = parent.contains(el);
        if (!isChild && parent instanceof HTMLSlotElement) {
            const children = [ ...parent.assignedElements() ];
            isChild = children.includes(el);
            if (!isChild) isChild = elementIsChildOfSlot(el, parent);
        }
        return isChild;
    }
    function showWarning(text) {
        try {
            console.warn(text);
        } catch {}
    }
    function createElement(tag, classes = []) {
        const el = document.createElement(tag);
        el.classList.add(...Array.isArray(classes) ? classes : classesToTokens(classes));
        return el;
    }
    function elementPrevAll(el, selector) {
        const prevEls = [];
        let prev = el.previousElementSibling;
        while (prev) {
            if (!selector || prev.matches(selector)) prevEls.push(prev);
            prev = prev.previousElementSibling;
        }
        return prevEls;
    }
    function elementNextAll(el, selector) {
        const nextEls = [];
        let next = el.nextElementSibling;
        while (next) {
            if (!selector || next.matches(selector)) nextEls.push(next);
            next = next.nextElementSibling;
        }
        return nextEls;
    }
    function elementStyle(el, prop) {
        return window.getComputedStyle(el, null).getPropertyValue(prop);
    }
    function elementIndex(el) {
        if (!el || !el.parentNode) return;
        return [ ...el.parentNode.children ].indexOf(el);
    }
    function elementParents(el, selector) {
        const parents = [];
        let parent = el.parentElement;
        while (parent) {
            if (!selector || parent.matches(selector)) parents.push(parent);
            parent = parent.parentElement;
        }
        return parents;
    }
    function elementOuterSize(el, size, includeMargins) {
        {
            const style = window.getComputedStyle(el, null);
            return el[size === "width" ? "offsetWidth" : "offsetHeight"] + parseFloat(style.getPropertyValue(size === "width" ? "margin-right" : "margin-top")) + parseFloat(style.getPropertyValue(size === "width" ? "margin-left" : "margin-bottom"));
        }
    }
    function makeElementsArray(el) {
        return (Array.isArray(el) ? el : [ el ]).filter(e => !!e);
    }
    function setInnerHTML(el, html = "") {
        const tt = globalThis.trustedTypes;
        if (typeof tt !== "undefined") el.innerHTML = tt.createPolicy("html", {
            createHTML: s => s
        }).createHTML(html); else el.innerHTML = html;
    }
    let supportCached;
    function calcSupport() {
        if (typeof window === "undefined") return {
            touch: false
        };
        return {
            touch: "ontouchstart" in window || navigator.maxTouchPoints > 0
        };
    }
    function getSupport() {
        if (!supportCached) supportCached = calcSupport();
        return supportCached;
    }
    let deviceCached;
    function calcDevice({userAgent} = {}) {
        if (typeof window === "undefined") return {
            ios: false,
            android: false
        };
        const support = getSupport();
        const platform = navigator.platform;
        const ua = userAgent || navigator.userAgent;
        const device = {
            ios: false,
            android: false
        };
        const isAndroid = /(Android);?[\s/]+([\d.]+)?/.test(ua);
        const isIPhoneOrIPod = /(iPhone\sOS|iOS|iPod)/.test(ua);
        const isIPadDirect = /iPad/.test(ua);
        const isIPadMasquerade = platform === "MacIntel" && support.touch && navigator.maxTouchPoints > 1;
        const isIPad = isIPadDirect || isIPadMasquerade;
        const isWindows = platform === "Win32";
        if (isAndroid && !isWindows) {
            device.os = "android";
            device.android = true;
        }
        if (isIPad || isIPhoneOrIPod) {
            device.os = "ios";
            device.ios = true;
        }
        return device;
    }
    function getDevice(overrides = {}) {
        if (!deviceCached) deviceCached = calcDevice(overrides);
        return deviceCached;
    }
    let browserCached;
    function calcBrowser() {
        if (typeof window === "undefined") return {
            isSafari: false,
            isWebView: false,
            need3dFix: false
        };
        const device = getDevice();
        const ua = navigator.userAgent;
        const uaLower = ua.toLowerCase();
        const isSafari = uaLower.includes("safari") && !uaLower.includes("chrome") && !uaLower.includes("android");
        const isWebView = /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(ua);
        const need3dFix = isSafari || isWebView && device.ios;
        return {
            isSafari,
            isWebView,
            need3dFix
        };
    }
    function getBrowser() {
        if (!browserCached) browserCached = calcBrowser();
        return browserCached;
    }
    const processLazyPreloader = (swiper, imageEl) => {
        if (!swiper || swiper.destroyed || !swiper.params) return;
        const slideSelector = () => swiper.isElement ? "swiper-slide" : `.${swiper.params.slideClass}`;
        const slideEl = imageEl.closest(slideSelector());
        if (slideEl) {
            let lazyEl = slideEl.querySelector(`.${swiper.params.lazyPreloaderClass}`);
            if (!lazyEl && swiper.isElement) if (slideEl.shadowRoot) lazyEl = slideEl.shadowRoot.querySelector(`.${swiper.params.lazyPreloaderClass}`); else requestAnimationFrame(() => {
                if (slideEl.shadowRoot) {
                    const innerLazy = slideEl.shadowRoot.querySelector(`.${swiper.params.lazyPreloaderClass}`);
                    if (innerLazy && !innerLazy.lazyPreloaderManaged) innerLazy.remove();
                }
            });
            if (lazyEl && !lazyEl.lazyPreloaderManaged) lazyEl.remove();
        }
    };
    const unlazy = (swiper, index) => {
        if (!swiper.slides[index]) return;
        const imageEl = swiper.slides[index].querySelector('[loading="lazy"]');
        if (imageEl) imageEl.removeAttribute("loading");
    };
    const preload = swiper => {
        if (!swiper || swiper.destroyed || !swiper.params) return;
        let amount = swiper.params.lazyPreloadPrevNext;
        const len = swiper.slides.length;
        if (!len || !amount || amount < 0) return;
        amount = Math.min(amount, len);
        const slidesPerView = swiper.params.slidesPerView === "auto" ? swiper.slidesPerViewDynamic() : Math.ceil(swiper.params.slidesPerView);
        const activeIndex = swiper.activeIndex;
        if (swiper.params.grid && (swiper.params.grid.rows ?? 1) > 1) {
            const activeColumn = activeIndex;
            const preloadColumns = [ activeColumn - amount ];
            preloadColumns.push(...Array.from({
                length: amount
            }).map((_, i) => activeColumn + slidesPerView + i));
            swiper.slides.forEach((slideEl, i) => {
                if (slideEl.column !== void 0 && preloadColumns.includes(slideEl.column)) unlazy(swiper, i);
            });
            return;
        }
        const slideIndexLastInView = activeIndex + slidesPerView - 1;
        if (swiper.params.rewind || swiper.params.loop) for (let i = activeIndex - amount; i <= slideIndexLastInView + amount; i += 1) {
            const realIndex = (i % len + len) % len;
            if (realIndex < activeIndex || realIndex > slideIndexLastInView) unlazy(swiper, realIndex);
        } else for (let i = Math.max(activeIndex - amount, 0); i <= Math.min(slideIndexLastInView + amount, len - 1); i += 1) if (i !== activeIndex && (i > slideIndexLastInView || i < activeIndex)) unlazy(swiper, i);
    };
    function getBreakpoint(breakpoints, base = "window", containerEl) {
        if (!breakpoints || base === "container" && !containerEl) return;
        let breakpoint = false;
        const currentHeight = base === "window" ? window.innerHeight : containerEl.clientHeight;
        const points = Object.keys(breakpoints).map(point => {
            if (typeof point === "string" && point.indexOf("@") === 0) {
                const minRatio = parseFloat(point.substr(1));
                const value = currentHeight * minRatio;
                return {
                    value,
                    point
                };
            }
            return {
                value: point,
                point
            };
        });
        points.sort((a, b) => parseInt(String(a.value), 10) - parseInt(String(b.value), 10));
        for (let i = 0; i < points.length; i += 1) {
            const {point, value} = points[i];
            if (base === "window") {
                if (window.matchMedia(`(min-width: ${value}px)`).matches) breakpoint = point;
            } else if (value <= containerEl.clientWidth) breakpoint = point;
        }
        return breakpoint || "max";
    }
    const isGridEnabled = (swiper, params) => !!(swiper.grid && params.grid && params.grid.rows > 1);
    function setBreakpoint() {
        const swiper = this;
        const {realIndex, initialized, params, el} = swiper;
        const breakpoints = params.breakpoints;
        if (!breakpoints || breakpoints && Object.keys(breakpoints).length === 0) return;
        const breakpointsBase = params.breakpointsBase === "window" || !params.breakpointsBase ? params.breakpointsBase : "container";
        const breakpointContainer = [ "window", "container" ].includes(params.breakpointsBase) || !params.breakpointsBase ? swiper.el : document.querySelector(params.breakpointsBase);
        const breakpoint = swiper.getBreakpoint(breakpoints, breakpointsBase, breakpointContainer);
        if (!breakpoint || swiper.currentBreakpoint === breakpoint) return;
        const breakpointsRecord = breakpoints;
        const breakpointOnlyParams = breakpoint in breakpointsRecord ? breakpointsRecord[breakpoint] : void 0;
        const breakpointParams = breakpointOnlyParams || swiper.originalParams;
        const wasMultiRow = isGridEnabled(swiper, params);
        const isMultiRow = isGridEnabled(swiper, breakpointParams);
        const wasGrabCursor = swiper.params.grabCursor;
        const isGrabCursor = breakpointParams.grabCursor;
        const wasEnabled = params.enabled;
        if (wasMultiRow && !isMultiRow) {
            el.classList.remove(`${params.containerModifierClass}grid`, `${params.containerModifierClass}grid-column`);
            swiper.emitContainerClasses();
        } else if (!wasMultiRow && isMultiRow) {
            el.classList.add(`${params.containerModifierClass}grid`);
            if (breakpointParams.grid.fill && breakpointParams.grid.fill === "column" || !breakpointParams.grid.fill && params.grid.fill === "column") el.classList.add(`${params.containerModifierClass}grid-column`);
            swiper.emitContainerClasses();
        }
        if (wasGrabCursor && !isGrabCursor) swiper.unsetGrabCursor(); else if (!wasGrabCursor && isGrabCursor) swiper.setGrabCursor();
        const moduleOpt = (opts, prop) => opts[prop];
        [ "navigation", "pagination", "scrollbar" ].forEach(prop => {
            const bpOpts = moduleOpt(breakpointParams, prop);
            if (typeof bpOpts === "undefined") return;
            const paramsOpts = moduleOpt(params, prop);
            const wasModuleEnabled = typeof paramsOpts === "object" && paramsOpts !== null && paramsOpts.enabled;
            const isModuleEnabled = typeof bpOpts === "object" && bpOpts !== null && bpOpts.enabled;
            const moduleApi = swiper[prop];
            if (wasModuleEnabled && !isModuleEnabled) moduleApi?.disable?.();
            if (!wasModuleEnabled && isModuleEnabled) moduleApi?.enable?.();
        });
        const directionChanged = breakpointParams.direction && breakpointParams.direction !== params.direction;
        const needsReLoop = params.loop && (breakpointParams.slidesPerView !== params.slidesPerView || directionChanged);
        const wasLoop = params.loop;
        if (directionChanged && initialized) swiper.changeDirection();
        extend(swiper.params, breakpointParams);
        const isEnabled = swiper.params.enabled;
        const hasLoop = swiper.params.loop;
        Object.assign(swiper, {
            allowTouchMove: swiper.params.allowTouchMove,
            allowSlideNext: swiper.params.allowSlideNext,
            allowSlidePrev: swiper.params.allowSlidePrev
        });
        if (wasEnabled && !isEnabled) swiper.disable(); else if (!wasEnabled && isEnabled) swiper.enable();
        swiper.currentBreakpoint = breakpoint;
        swiper.emit("_beforeBreakpoint", breakpointParams);
        if (initialized) if (needsReLoop) {
            swiper.loopDestroy();
            swiper.loopCreate(realIndex);
            swiper.updateSlides();
        } else if (!wasLoop && hasLoop) {
            swiper.loopCreate(realIndex);
            swiper.updateSlides();
        } else if (wasLoop && !hasLoop) swiper.loopDestroy();
        swiper.emit("breakpoint", breakpointParams);
    }
    var breakpoints = {
        setBreakpoint,
        getBreakpoint
    };
    function checkOverflow() {
        const swiper = this;
        const {isLocked: wasLocked, params} = swiper;
        const {slidesOffsetBefore} = params;
        if (slidesOffsetBefore) {
            const lastSlideIndex = swiper.slides.length - 1;
            const lastSlideRightEdge = swiper.slidesGrid[lastSlideIndex] + swiper.slidesSizesGrid[lastSlideIndex] + slidesOffsetBefore * 2;
            swiper.isLocked = swiper.size > lastSlideRightEdge;
        } else swiper.isLocked = swiper.snapGrid.length === 1;
        if (params.allowSlideNext === true) swiper.allowSlideNext = !swiper.isLocked;
        if (params.allowSlidePrev === true) swiper.allowSlidePrev = !swiper.isLocked;
        if (wasLocked && wasLocked !== swiper.isLocked) swiper.isEnd = false;
        if (wasLocked !== swiper.isLocked) swiper.emit(swiper.isLocked ? "lock" : "unlock");
    }
    var checkOverflow$1 = {
        checkOverflow
    };
    function prepareClasses(entries, prefix) {
        const resultClasses = [];
        entries.forEach(item => {
            if (typeof item === "object") Object.keys(item).forEach(classNames => {
                if (item[classNames]) resultClasses.push(prefix + classNames);
            }); else if (typeof item === "string") resultClasses.push(prefix + item);
        });
        return resultClasses;
    }
    function addClasses() {
        const swiper = this;
        const {classNames, params, rtl, el, device} = swiper;
        const suffixes = prepareClasses([ "initialized", params.direction, {
            "free-mode": swiper.params.freeMode && params.freeMode.enabled
        }, {
            autoheight: params.autoHeight
        }, {
            rtl
        }, {
            grid: params.grid && params.grid.rows > 1
        }, {
            "grid-column": params.grid && params.grid.rows > 1 && params.grid.fill === "column"
        }, {
            android: device.android
        }, {
            ios: device.ios
        }, {
            "css-mode": params.cssMode
        }, {
            centered: params.cssMode && params.centeredSlides
        }, {
            "watch-progress": params.watchSlidesProgress
        } ], params.containerModifierClass);
        classNames.push(...suffixes);
        el.classList.add(...classNames);
        swiper.emitContainerClasses();
    }
    function swiper_core_removeClasses() {
        const swiper = this;
        const {el, classNames} = swiper;
        if (!el || typeof el === "string") return;
        el.classList.remove(...classNames);
        swiper.emitContainerClasses();
    }
    var classes = {
        addClasses,
        removeClasses: swiper_core_removeClasses
    };
    const defaults = {
        init: true,
        direction: "horizontal",
        oneWayMovement: false,
        swiperElementNodeName: "SWIPER-CONTAINER",
        touchEventsTarget: "wrapper",
        initialSlide: 0,
        speed: 300,
        cssMode: false,
        updateOnWindowResize: true,
        resizeObserver: true,
        nested: false,
        createElements: false,
        eventsPrefix: "swiper",
        enabled: true,
        focusableElements: "input, select, option, textarea, button, video, label",
        width: null,
        height: null,
        preventInteractionOnTransition: false,
        userAgent: null,
        url: null,
        edgeSwipeDetection: false,
        edgeSwipeThreshold: 20,
        autoHeight: false,
        setWrapperSize: false,
        virtualTranslate: false,
        effect: "slide",
        breakpoints: void 0,
        breakpointsBase: "window",
        spaceBetween: 0,
        slidesPerView: 1,
        slidesPerGroup: 1,
        slidesPerGroupSkip: 0,
        slidesPerGroupAuto: false,
        centeredSlides: false,
        centeredSlidesBounds: false,
        slidesOffsetBefore: 0,
        slidesOffsetAfter: 0,
        normalizeSlideIndex: true,
        centerInsufficientSlides: false,
        snapToSlideEdge: false,
        watchOverflow: true,
        roundLengths: false,
        touchRatio: 1,
        touchAngle: 45,
        simulateTouch: true,
        shortSwipes: true,
        longSwipes: true,
        longSwipesRatio: .5,
        longSwipesMs: 300,
        followFinger: true,
        allowTouchMove: true,
        threshold: 5,
        touchMoveStopPropagation: false,
        touchStartPreventDefault: true,
        touchStartForcePreventDefault: false,
        touchReleaseOnEdges: false,
        uniqueNavElements: true,
        resistance: true,
        resistanceRatio: .85,
        watchSlidesProgress: false,
        grabCursor: false,
        preventClicks: true,
        preventClicksPropagation: true,
        slideToClickedSlide: false,
        loop: false,
        loopAddBlankSlides: true,
        loopAdditionalSlides: 0,
        loopPreventsSliding: true,
        rewind: false,
        allowSlidePrev: true,
        allowSlideNext: true,
        swipeHandler: null,
        noSwiping: true,
        noSwipingClass: "swiper-no-swiping",
        noSwipingSelector: null,
        passiveListeners: true,
        maxBackfaceHiddenSlides: 10,
        containerModifierClass: "swiper-",
        slideClass: "swiper-slide",
        slideBlankClass: "swiper-slide-blank",
        slideActiveClass: "swiper-slide-active",
        slideVisibleClass: "swiper-slide-visible",
        slideFullyVisibleClass: "swiper-slide-fully-visible",
        slideNextClass: "swiper-slide-next",
        slidePrevClass: "swiper-slide-prev",
        wrapperClass: "swiper-wrapper",
        lazyPreloaderClass: "swiper-lazy-preloader",
        lazyPreloadPrevNext: 0,
        runCallbacksOnInit: true,
        _emitClasses: false
    };
    var eventsEmitter = {
        on(events, handler, priority) {
            const self = this;
            if (!self.eventsListeners || self.destroyed) return self;
            if (typeof handler !== "function") return self;
            const method = priority ? "unshift" : "push";
            events.split(" ").forEach(event => {
                if (!self.eventsListeners[event]) self.eventsListeners[event] = [];
                self.eventsListeners[event][method](handler);
            });
            return self;
        },
        once(events, handler, priority) {
            const self = this;
            if (!self.eventsListeners || self.destroyed) return self;
            if (typeof handler !== "function") return self;
            const onceHandler = function onceHandlerFn(...args) {
                self.off(events, onceHandler);
                if (onceHandler.__emitterProxy) delete onceHandler.__emitterProxy;
                handler.apply(self, args);
            };
            onceHandler.__emitterProxy = handler;
            return self.on(events, onceHandler, priority);
        },
        onAny(handler, priority) {
            const self = this;
            if (!self.eventsListeners || self.destroyed) return self;
            if (typeof handler !== "function") return self;
            const method = priority ? "unshift" : "push";
            if (self.eventsAnyListeners.indexOf(handler) < 0) self.eventsAnyListeners[method](handler);
            return self;
        },
        offAny(handler) {
            const self = this;
            if (!self.eventsListeners || self.destroyed) return self;
            if (!self.eventsAnyListeners) return self;
            const index = self.eventsAnyListeners.indexOf(handler);
            if (index >= 0) self.eventsAnyListeners.splice(index, 1);
            return self;
        },
        off(events, handler) {
            const self = this;
            if (!self.eventsListeners || self.destroyed) return self;
            if (!self.eventsListeners) return self;
            events.split(" ").forEach(event => {
                if (typeof handler === "undefined") self.eventsListeners[event] = []; else if (self.eventsListeners[event]) self.eventsListeners[event].forEach((eventHandler, index) => {
                    if (eventHandler === handler || eventHandler.__emitterProxy && eventHandler.__emitterProxy === handler) self.eventsListeners[event].splice(index, 1);
                });
            });
            return self;
        },
        emit(...args) {
            const self = this;
            if (!self.eventsListeners || self.destroyed) return self;
            if (!self.eventsListeners) return self;
            let events;
            let data;
            let context;
            if (typeof args[0] === "string" || Array.isArray(args[0])) {
                events = args[0];
                data = args.slice(1, args.length);
                context = self;
            } else {
                const opts = args[0];
                events = opts.events;
                data = opts.data ?? [];
                context = opts.context || self;
            }
            data.unshift(context);
            const eventsArray = Array.isArray(events) ? events : events.split(" ");
            eventsArray.forEach(event => {
                if (self.eventsAnyListeners && self.eventsAnyListeners.length) self.eventsAnyListeners.forEach(eventHandler => {
                    eventHandler.apply(context, [ event, ...data ]);
                });
                if (self.eventsListeners && self.eventsListeners[event]) self.eventsListeners[event].forEach(eventHandler => {
                    eventHandler.apply(context, data);
                });
            });
            return self;
        }
    };
    function onClick(e) {
        const swiper = this;
        if (swiper.destroyed) return;
        if (!swiper.enabled) return;
        if (!swiper.allowClick) {
            if (swiper.params.preventClicks) e.preventDefault();
            if (swiper.params.preventClicksPropagation && swiper.animating) {
                e.stopPropagation();
                e.stopImmediatePropagation();
            }
        }
    }
    function onDocumentTouchStart() {
        const swiper = this;
        if (swiper.destroyed) return;
        if (swiper.documentTouchHandlerProceeded) return;
        swiper.documentTouchHandlerProceeded = true;
        if (swiper.params.touchReleaseOnEdges) swiper.el.style.touchAction = "auto";
    }
    function onLoad(e) {
        const swiper = this;
        if (swiper.destroyed) return;
        processLazyPreloader(swiper, e.target);
        if (swiper.params.cssMode || swiper.params.slidesPerView !== "auto" && !swiper.params.autoHeight) return;
        swiper.update();
    }
    function onResize() {
        const swiper = this;
        const {params, el} = swiper;
        if (el && el.offsetWidth === 0) return;
        if (params.breakpoints) swiper.setBreakpoint();
        const {allowSlideNext, allowSlidePrev, snapGrid} = swiper;
        const isVirtual = swiper.virtual && swiper.params.virtual?.enabled;
        swiper.allowSlideNext = true;
        swiper.allowSlidePrev = true;
        swiper.updateSize();
        swiper.updateSlides();
        swiper.updateSlidesClasses();
        const isVirtualLoop = isVirtual && params.loop;
        if ((params.slidesPerView === "auto" || params.slidesPerView > 1) && swiper.isEnd && !swiper.isBeginning && !swiper.params.centeredSlides && !isVirtualLoop) {
            const slidesLength = isVirtual ? swiper.virtual.slides.length : swiper.slides.length;
            swiper.slideTo(slidesLength - 1, 0, false, true);
        } else if (swiper.params.loop && !isVirtual) swiper.slideToLoop(swiper.realIndex, 0, false, true); else swiper.slideTo(swiper.activeIndex, 0, false, true);
        if (swiper.autoplay && swiper.autoplay.running && swiper.autoplay.paused) {
            const autoplay = swiper.autoplay;
            clearTimeout(autoplay.resizeTimeout);
            autoplay.resizeTimeout = setTimeout(() => {
                if (swiper.autoplay && swiper.autoplay.running && swiper.autoplay.paused) swiper.autoplay.resume();
            }, 500);
        }
        swiper.allowSlidePrev = allowSlidePrev;
        swiper.allowSlideNext = allowSlideNext;
        if (swiper.params.watchOverflow && snapGrid !== swiper.snapGrid) swiper.checkOverflow();
    }
    function onScroll() {
        const swiper = this;
        if (swiper.destroyed) return;
        const {wrapperEl, rtlTranslate, enabled} = swiper;
        if (!enabled) return;
        swiper.previousTranslate = swiper.translate;
        if (swiper.isHorizontal()) swiper.translate = -wrapperEl.scrollLeft; else swiper.translate = -wrapperEl.scrollTop;
        if (swiper.translate === 0) swiper.translate = 0;
        swiper.updateActiveIndex();
        swiper.updateSlidesClasses();
        let newProgress;
        const translatesDiff = swiper.maxTranslate() - swiper.minTranslate();
        if (translatesDiff === 0) newProgress = 0; else newProgress = (swiper.translate - swiper.minTranslate()) / translatesDiff;
        if (newProgress !== swiper.progress) swiper.updateProgress(rtlTranslate ? -swiper.translate : swiper.translate);
        swiper.emit("setTranslate", swiper.translate, false);
    }
    function onTouchEnd(event) {
        const swiper = this;
        if (swiper.destroyed) return;
        const data = swiper.touchEventsData;
        let e = event.originalEvent ?? event;
        const isTouchEvent = e.type === "touchend" || e.type === "touchcancel";
        if (!isTouchEvent) {
            if (data.touchId !== null) return;
            const pe = e;
            if (pe.pointerId !== data.pointerId) return;
        } else {
            const te = e;
            const found = [ ...te.changedTouches ].find(t => t.identifier === data.touchId);
            if (!found || found.identifier !== data.touchId) return;
        }
        if ([ "pointercancel", "pointerout", "pointerleave", "contextmenu" ].includes(e.type)) {
            const proceed = [ "pointercancel", "contextmenu" ].includes(e.type) && (swiper.browser.isSafari || swiper.browser.isWebView);
            if (!proceed) return;
        }
        data.pointerId = null;
        data.touchId = null;
        const {params, touches, rtlTranslate: rtl, slidesGrid, enabled} = swiper;
        if (!enabled) return;
        if (!params.simulateTouch && e.pointerType === "mouse") return;
        if (data.allowTouchCallbacks) swiper.emit("touchEnd", e);
        data.allowTouchCallbacks = false;
        if (!data.isTouched) {
            if (data.isMoved && params.grabCursor) swiper.setGrabCursor(false);
            data.isMoved = false;
            data.startMoving = false;
            return;
        }
        if (params.grabCursor && data.isMoved && data.isTouched && (swiper.allowSlideNext === true || swiper.allowSlidePrev === true)) swiper.setGrabCursor(false);
        const touchEndTime = now();
        const timeDiff = touchEndTime - data.touchStartTime;
        if (swiper.allowClick) {
            const pathTree = e.path ?? (e.composedPath && e.composedPath());
            swiper.updateClickedSlide(pathTree && pathTree[0], pathTree);
            swiper.emit("tap click", e);
            if (timeDiff < 300 && touchEndTime - data.lastClickTime < 300) swiper.emit("doubleTap doubleClick", e);
        }
        data.lastClickTime = now();
        nextTick(() => {
            if (!swiper.destroyed) swiper.allowClick = true;
        });
        if (!data.isTouched || !data.isMoved || !swiper.swipeDirection || touches.diff === 0 && !data.loopSwapReset || data.currentTranslate === data.startTranslate && !data.loopSwapReset) {
            data.isTouched = false;
            data.isMoved = false;
            data.startMoving = false;
            return;
        }
        data.isTouched = false;
        data.isMoved = false;
        data.startMoving = false;
        let currentPos;
        if (params.followFinger) currentPos = rtl ? swiper.translate : -swiper.translate; else currentPos = -(data.currentTranslate ?? 0);
        if (params.cssMode) return;
        if (params.freeMode && params.freeMode.enabled) {
            swiper.freeMode.onTouchEnd({
                currentPos
            });
            return;
        }
        const swipeToLast = currentPos >= -swiper.maxTranslate() && !swiper.params.loop;
        let stopIndex = 0;
        let groupSize = swiper.slidesSizesGrid[0];
        for (let i = 0; i < slidesGrid.length; i += i < params.slidesPerGroupSkip ? 1 : params.slidesPerGroup) {
            const increment = i < params.slidesPerGroupSkip - 1 ? 1 : params.slidesPerGroup;
            if (typeof slidesGrid[i + increment] !== "undefined") {
                if (swipeToLast || currentPos >= slidesGrid[i] && currentPos < slidesGrid[i + increment]) {
                    stopIndex = i;
                    groupSize = slidesGrid[i + increment] - slidesGrid[i];
                }
            } else if (swipeToLast || currentPos >= slidesGrid[i]) {
                stopIndex = i;
                groupSize = slidesGrid[slidesGrid.length - 1] - slidesGrid[slidesGrid.length - 2];
            }
        }
        let rewindFirstIndex = null;
        let rewindLastIndex = null;
        if (params.rewind) if (swiper.isBeginning) rewindLastIndex = params.virtual?.enabled && swiper.virtual ? swiper.virtual.slides.length - 1 : swiper.slides.length - 1; else if (swiper.isEnd) rewindFirstIndex = 0;
        const ratio = (currentPos - slidesGrid[stopIndex]) / groupSize;
        const increment = stopIndex < params.slidesPerGroupSkip - 1 ? 1 : params.slidesPerGroup;
        if (timeDiff > params.longSwipesMs) {
            if (!params.longSwipes) {
                swiper.slideTo(swiper.activeIndex);
                return;
            }
            if (swiper.swipeDirection === "next") if (ratio >= params.longSwipesRatio) swiper.slideTo(params.rewind && swiper.isEnd ? rewindFirstIndex : stopIndex + increment); else swiper.slideTo(stopIndex);
            if (swiper.swipeDirection === "prev") if (ratio > 1 - params.longSwipesRatio) swiper.slideTo(stopIndex + increment); else if (rewindLastIndex !== null && ratio < 0 && Math.abs(ratio) > params.longSwipesRatio) swiper.slideTo(rewindLastIndex); else swiper.slideTo(stopIndex);
        } else {
            if (!params.shortSwipes) {
                swiper.slideTo(swiper.activeIndex);
                return;
            }
            const isNavButtonTarget = swiper.navigation && (e.target === swiper.navigation.nextEl || e.target === swiper.navigation.prevEl);
            if (!isNavButtonTarget) {
                if (swiper.swipeDirection === "next") swiper.slideTo(rewindFirstIndex !== null ? rewindFirstIndex : stopIndex + increment);
                if (swiper.swipeDirection === "prev") swiper.slideTo(rewindLastIndex !== null ? rewindLastIndex : stopIndex);
            } else if (e.target === swiper.navigation.nextEl) swiper.slideTo(stopIndex + increment); else swiper.slideTo(stopIndex);
        }
    }
    function onTouchMove(event) {
        const swiper = this;
        if (swiper.destroyed) return;
        const data = swiper.touchEventsData;
        const {params, touches, rtlTranslate: rtl, enabled} = swiper;
        if (!enabled) return;
        if (!params.simulateTouch && event.pointerType === "mouse") return;
        const wrapped = event;
        const e = wrapped.originalEvent ?? wrapped;
        if (e.type === "pointermove") {
            if (data.touchId !== null) return;
            const pe = e;
            if (pe.pointerId !== data.pointerId) return;
        }
        let targetTouch;
        if (e.type === "touchmove") {
            const te = e;
            const found = [ ...te.changedTouches ].find(t => t.identifier === data.touchId);
            if (!found || found.identifier !== data.touchId) return;
            targetTouch = found;
        } else targetTouch = e;
        if (!data.isTouched) {
            if (data.startMoving && data.isScrolling) swiper.emit("touchMoveOpposite", e);
            return;
        }
        const pageX = targetTouch.pageX;
        const pageY = targetTouch.pageY;
        if (e.preventedByNestedSwiper) {
            touches.startX = pageX;
            touches.startY = pageY;
            return;
        }
        if (!swiper.allowTouchMove) {
            if (!e.target.matches(data.focusableElements)) swiper.allowClick = false;
            if (data.isTouched) {
                Object.assign(touches, {
                    startX: pageX,
                    startY: pageY,
                    currentX: pageX,
                    currentY: pageY
                });
                data.touchStartTime = now();
            }
            return;
        }
        if (params.touchReleaseOnEdges && !params.loop) if (swiper.isVertical()) {
            if (pageY < touches.startY && swiper.translate <= swiper.maxTranslate() || pageY > touches.startY && swiper.translate >= swiper.minTranslate()) {
                data.isTouched = false;
                data.isMoved = false;
                return;
            }
        } else if (rtl && (pageX > touches.startX && -swiper.translate <= swiper.maxTranslate() || pageX < touches.startX && -swiper.translate >= swiper.minTranslate())) return; else if (!rtl && (pageX < touches.startX && swiper.translate <= swiper.maxTranslate() || pageX > touches.startX && swiper.translate >= swiper.minTranslate())) return;
        if (document.activeElement && document.activeElement.matches(data.focusableElements) && document.activeElement !== e.target && e.pointerType !== "mouse") document.activeElement.blur();
        if (document.activeElement) if (e.target === document.activeElement && e.target.matches(data.focusableElements)) {
            data.isMoved = true;
            swiper.allowClick = false;
            return;
        }
        if (data.allowTouchCallbacks) swiper.emit("touchMove", e);
        touches.previousX = touches.currentX;
        touches.previousY = touches.currentY;
        touches.currentX = pageX;
        touches.currentY = pageY;
        const diffX = touches.currentX - touches.startX;
        const diffY = touches.currentY - touches.startY;
        if (swiper.params.threshold && Math.sqrt(diffX ** 2 + diffY ** 2) < swiper.params.threshold) return;
        if (typeof data.isScrolling === "undefined") {
            let touchAngle;
            if (swiper.isHorizontal() && touches.currentY === touches.startY || swiper.isVertical() && touches.currentX === touches.startX) data.isScrolling = false; else if (diffX * diffX + diffY * diffY >= 25) {
                touchAngle = Math.atan2(Math.abs(diffY), Math.abs(diffX)) * 180 / Math.PI;
                data.isScrolling = swiper.isHorizontal() ? touchAngle > params.touchAngle : 90 - touchAngle > params.touchAngle;
            }
        }
        if (data.isScrolling) swiper.emit("touchMoveOpposite", e);
        if (typeof data.startMoving === "undefined") if (touches.currentX !== touches.startX || touches.currentY !== touches.startY) data.startMoving = true;
        if (data.isScrolling || e.type === "touchmove" && data.preventTouchMoveFromPointerMove) {
            data.isTouched = false;
            return;
        }
        if (!data.startMoving) return;
        swiper.allowClick = false;
        if (!params.cssMode && e.cancelable) e.preventDefault();
        if (params.touchMoveStopPropagation && !params.nested) e.stopPropagation();
        let diff = swiper.isHorizontal() ? diffX : diffY;
        let touchesDiff = swiper.isHorizontal() ? touches.currentX - touches.previousX : touches.currentY - touches.previousY;
        if (params.oneWayMovement) {
            diff = Math.abs(diff) * (rtl ? 1 : -1);
            touchesDiff = Math.abs(touchesDiff) * (rtl ? 1 : -1);
        }
        touches.diff = diff;
        diff *= params.touchRatio;
        if (rtl) {
            diff = -diff;
            touchesDiff = -touchesDiff;
        }
        const prevTouchesDirection = swiper.touchesDirection;
        swiper.swipeDirection = diff > 0 ? "prev" : "next";
        swiper.touchesDirection = touchesDiff > 0 ? "prev" : "next";
        const isLoop = swiper.params.loop && !params.cssMode;
        const allowLoopFix = swiper.touchesDirection === "next" && swiper.allowSlideNext || swiper.touchesDirection === "prev" && swiper.allowSlidePrev;
        if (!data.isMoved) {
            if (isLoop && allowLoopFix) swiper.loopFix({
                direction: swiper.swipeDirection
            });
            data.startTranslate = swiper.getTranslate();
            swiper.setTransition(0);
            if (swiper.animating) {
                const evt = new window.CustomEvent("transitionend", {
                    bubbles: true,
                    cancelable: true,
                    detail: {
                        bySwiperTouchMove: true
                    }
                });
                swiper.wrapperEl.dispatchEvent(evt);
            }
            data.allowMomentumBounce = false;
            if (params.grabCursor && (swiper.allowSlideNext === true || swiper.allowSlidePrev === true)) swiper.setGrabCursor(true);
            swiper.emit("sliderFirstMove", e);
        }
        (new Date).getTime();
        if (params._loopSwapReset !== false && data.isMoved && data.allowThresholdMove && prevTouchesDirection !== swiper.touchesDirection && isLoop && allowLoopFix && Math.abs(diff) >= 1) {
            Object.assign(touches, {
                startX: pageX,
                startY: pageY,
                currentX: pageX,
                currentY: pageY,
                startTranslate: data.currentTranslate
            });
            data.loopSwapReset = true;
            data.startTranslate = data.currentTranslate;
            return;
        }
        swiper.emit("sliderMove", e);
        data.isMoved = true;
        const startTranslate = data.startTranslate ?? 0;
        data.currentTranslate = diff + startTranslate;
        let disableParentSwiper = true;
        let resistanceRatio = params.resistanceRatio;
        if (params.touchReleaseOnEdges) resistanceRatio = 0;
        if (diff > 0) {
            if (isLoop && allowLoopFix && true && data.allowThresholdMove && data.currentTranslate > (params.centeredSlides ? swiper.minTranslate() - swiper.slidesSizesGrid[swiper.activeIndex + 1] - (params.slidesPerView !== "auto" && swiper.slides.length - params.slidesPerView >= 2 ? swiper.slidesSizesGrid[swiper.activeIndex + 1] + swiper.params.spaceBetween : 0) - swiper.params.spaceBetween : swiper.minTranslate())) swiper.loopFix({
                direction: "prev",
                setTranslate: true,
                activeSlideIndex: 0
            });
            if (data.currentTranslate > swiper.minTranslate()) {
                disableParentSwiper = false;
                if (params.resistance) data.currentTranslate = swiper.minTranslate() - 1 + (-swiper.minTranslate() + startTranslate + diff) ** resistanceRatio;
            }
        } else if (diff < 0) {
            if (isLoop && allowLoopFix && true && data.allowThresholdMove && data.currentTranslate < (params.centeredSlides ? swiper.maxTranslate() + swiper.slidesSizesGrid[swiper.slidesSizesGrid.length - 1] + swiper.params.spaceBetween + (params.slidesPerView !== "auto" && swiper.slides.length - params.slidesPerView >= 2 ? swiper.slidesSizesGrid[swiper.slidesSizesGrid.length - 1] + swiper.params.spaceBetween : 0) : swiper.maxTranslate())) swiper.loopFix({
                direction: "next",
                setTranslate: true,
                activeSlideIndex: swiper.slides.length - (params.slidesPerView === "auto" ? swiper.slidesPerViewDynamic() : Math.ceil(parseFloat(String(params.slidesPerView))))
            });
            if (data.currentTranslate < swiper.maxTranslate()) {
                disableParentSwiper = false;
                if (params.resistance) data.currentTranslate = swiper.maxTranslate() + 1 - (swiper.maxTranslate() - startTranslate - diff) ** resistanceRatio;
            }
        }
        if (disableParentSwiper) e.preventedByNestedSwiper = true;
        if (!swiper.allowSlideNext && swiper.swipeDirection === "next" && (data.currentTranslate ?? 0) < startTranslate) data.currentTranslate = startTranslate;
        if (!swiper.allowSlidePrev && swiper.swipeDirection === "prev" && (data.currentTranslate ?? 0) > startTranslate) data.currentTranslate = startTranslate;
        if (!swiper.allowSlidePrev && !swiper.allowSlideNext) data.currentTranslate = startTranslate;
        if (params.threshold > 0) if (Math.abs(diff) > params.threshold || data.allowThresholdMove) {
            if (!data.allowThresholdMove) {
                data.allowThresholdMove = true;
                touches.startX = touches.currentX;
                touches.startY = touches.currentY;
                data.currentTranslate = data.startTranslate;
                touches.diff = swiper.isHorizontal() ? touches.currentX - touches.startX : touches.currentY - touches.startY;
                return;
            }
        } else {
            data.currentTranslate = data.startTranslate;
            return;
        }
        if (!params.followFinger || params.cssMode) return;
        if (params.freeMode && params.freeMode.enabled && swiper.freeMode || params.watchSlidesProgress) {
            swiper.updateActiveIndex();
            swiper.updateSlidesClasses();
        }
        if (params.freeMode && params.freeMode.enabled && swiper.freeMode) swiper.freeMode.onTouchMove();
        swiper.updateProgress(data.currentTranslate);
        swiper.setTranslate(data.currentTranslate ?? 0);
    }
    function closestElement(selector, base) {
        function __closestFrom(el) {
            if (!el || el === document || el === window) return null;
            let cur = el;
            if (cur.assignedSlot) cur = cur.assignedSlot;
            const found = cur.closest(selector);
            if (!found && !cur.getRootNode) return null;
            const root = cur.getRootNode();
            return found || __closestFrom(root.host);
        }
        return __closestFrom(base);
    }
    function preventEdgeSwipe(swiper, event, startX) {
        const {params} = swiper;
        const edgeSwipeDetection = params.edgeSwipeDetection;
        const edgeSwipeThreshold = params.edgeSwipeThreshold;
        if (edgeSwipeDetection && (startX <= edgeSwipeThreshold || startX >= window.innerWidth - edgeSwipeThreshold)) {
            if (edgeSwipeDetection === "prevent") {
                event.preventDefault();
                return true;
            }
            return false;
        }
        return true;
    }
    function onTouchStart(event) {
        const swiper = this;
        if (swiper.destroyed) return;
        const e = event.originalEvent ?? event;
        const data = swiper.touchEventsData;
        if (e.type === "pointerdown") {
            const pe = e;
            if (data.pointerId !== null && data.pointerId !== pe.pointerId) return;
            data.pointerId = pe.pointerId;
        } else if (e.type === "touchstart" && e.targetTouches.length === 1) data.touchId = e.targetTouches[0].identifier;
        if (e.type === "touchstart") {
            preventEdgeSwipe(swiper, e, e.targetTouches[0].pageX);
            return;
        }
        const {params, touches, enabled} = swiper;
        if (!enabled) return;
        if (!params.simulateTouch && e.pointerType === "mouse") return;
        if (swiper.animating && params.preventInteractionOnTransition) return;
        if (!swiper.animating && params.cssMode && params.loop) swiper.loopFix();
        let targetEl = e.target;
        if (params.touchEventsTarget === "wrapper") if (!elementIsChildOf(targetEl, swiper.wrapperEl)) return;
        const mouseLike = e;
        if (typeof mouseLike.which === "number" && mouseLike.which === 3) return;
        if (typeof mouseLike.button === "number" && mouseLike.button > 0) return;
        if (data.isTouched && data.isMoved) return;
        const swipingClassHasValue = !!params.noSwipingClass && params.noSwipingClass !== "";
        const eventPath = e.composedPath ? e.composedPath() : e.path;
        if (swipingClassHasValue && e.target && e.target.shadowRoot && eventPath) targetEl = eventPath[0];
        const noSwipingSelector = params.noSwipingSelector ? params.noSwipingSelector : `.${params.noSwipingClass}`;
        const isTargetShadow = !!(e.target && e.target.shadowRoot);
        if (params.noSwiping && (isTargetShadow ? closestElement(noSwipingSelector, targetEl) : targetEl.closest(noSwipingSelector))) {
            swiper.allowClick = true;
            return;
        }
        if (params.swipeHandler) if (typeof params.swipeHandler === "string" && !targetEl.closest(params.swipeHandler)) return;
        const pe = e;
        touches.currentX = pe.pageX;
        touches.currentY = pe.pageY;
        const startX = touches.currentX;
        const startY = touches.currentY;
        if (!preventEdgeSwipe(swiper, e, startX)) return;
        Object.assign(data, {
            isTouched: true,
            isMoved: false,
            allowTouchCallbacks: true,
            isScrolling: void 0,
            startMoving: void 0
        });
        touches.startX = startX;
        touches.startY = startY;
        data.touchStartTime = now();
        swiper.allowClick = true;
        swiper.updateSize();
        swiper.swipeDirection = void 0;
        if (params.threshold > 0) data.allowThresholdMove = false;
        let preventDefault = true;
        if (targetEl.matches(data.focusableElements)) {
            preventDefault = false;
            if (targetEl.nodeName === "SELECT") data.isTouched = false;
        }
        if (document.activeElement && document.activeElement.matches(data.focusableElements) && document.activeElement !== targetEl && (pe.pointerType === "mouse" || pe.pointerType !== "mouse" && !targetEl.matches(data.focusableElements))) document.activeElement.blur();
        const shouldPreventDefault = preventDefault && swiper.allowTouchMove && params.touchStartPreventDefault;
        if ((params.touchStartForcePreventDefault || shouldPreventDefault) && !targetEl.isContentEditable) e.preventDefault();
        if (params.freeMode && params.freeMode.enabled && swiper.freeMode && swiper.animating && !params.cssMode) swiper.freeMode.onTouchStart();
        swiper.emit("touchStart", e);
    }
    const events = (swiper, method) => {
        const {params, el, wrapperEl, device} = swiper;
        const capture = !!params.nested;
        const domMethod = method === "on" ? "addEventListener" : "removeEventListener";
        const swiperMethod = method;
        if (!el || typeof el === "string") return;
        document[domMethod]("touchstart", swiper.onDocumentTouchStart, {
            passive: false,
            capture
        });
        el[domMethod]("touchstart", swiper.onTouchStart, {
            passive: false
        });
        el[domMethod]("pointerdown", swiper.onTouchStart, {
            passive: false
        });
        document[domMethod]("touchmove", swiper.onTouchMove, {
            passive: false,
            capture
        });
        document[domMethod]("pointermove", swiper.onTouchMove, {
            passive: false,
            capture
        });
        document[domMethod]("touchend", swiper.onTouchEnd, {
            passive: true
        });
        document[domMethod]("pointerup", swiper.onTouchEnd, {
            passive: true
        });
        document[domMethod]("pointercancel", swiper.onTouchEnd, {
            passive: true
        });
        document[domMethod]("touchcancel", swiper.onTouchEnd, {
            passive: true
        });
        document[domMethod]("pointerout", swiper.onTouchEnd, {
            passive: true
        });
        document[domMethod]("pointerleave", swiper.onTouchEnd, {
            passive: true
        });
        document[domMethod]("contextmenu", swiper.onTouchEnd, {
            passive: true
        });
        if (params.preventClicks || params.preventClicksPropagation) el[domMethod]("click", swiper.onClick, true);
        if (params.cssMode) wrapperEl[domMethod]("scroll", swiper.onScroll);
        const subscribe = events => {
            swiper[swiperMethod](events, onResize, true);
        };
        if (params.updateOnWindowResize) subscribe(device.ios || device.android ? "resize orientationchange observerUpdate" : "resize observerUpdate"); else subscribe("observerUpdate");
        el[domMethod]("load", swiper.onLoad, {
            capture: true
        });
    };
    function attachEvents() {
        const swiper = this;
        const {params} = swiper;
        swiper.onTouchStart = onTouchStart.bind(swiper);
        swiper.onTouchMove = onTouchMove.bind(swiper);
        swiper.onTouchEnd = onTouchEnd.bind(swiper);
        swiper.onDocumentTouchStart = onDocumentTouchStart.bind(swiper);
        if (params.cssMode) swiper.onScroll = onScroll.bind(swiper);
        swiper.onClick = onClick.bind(swiper);
        swiper.onLoad = onLoad.bind(swiper);
        events(swiper, "on");
    }
    function detachEvents() {
        const swiper = this;
        events(swiper, "off");
    }
    var events$1 = {
        attachEvents,
        detachEvents
    };
    function setGrabCursor(moving) {
        const swiper = this;
        if (!swiper.params.simulateTouch || swiper.params.watchOverflow && swiper.isLocked || swiper.params.cssMode) return;
        const el = swiper.params.touchEventsTarget === "container" ? swiper.el : swiper.wrapperEl;
        if (swiper.isElement) swiper.__preventObserver__ = true;
        el.style.cursor = "move";
        el.style.cursor = moving ? "grabbing" : "grab";
        if (swiper.isElement) requestAnimationFrame(() => {
            swiper.__preventObserver__ = false;
        });
    }
    function unsetGrabCursor() {
        const swiper = this;
        if (swiper.params.watchOverflow && swiper.isLocked || swiper.params.cssMode) return;
        if (swiper.isElement) swiper.__preventObserver__ = true;
        swiper[swiper.params.touchEventsTarget === "container" ? "el" : "wrapperEl"].style.cursor = "";
        if (swiper.isElement) requestAnimationFrame(() => {
            swiper.__preventObserver__ = false;
        });
    }
    var grabCursor = {
        setGrabCursor,
        unsetGrabCursor
    };
    function loopCreate(slideRealIndex, initial) {
        const swiper = this;
        const {params, slidesEl} = swiper;
        if (!params.loop || swiper.virtual && swiper.params.virtual?.enabled) return;
        const initSlides = () => {
            const slides = elementChildren(slidesEl, `.${params.slideClass}, swiper-slide`);
            slides.forEach((el, index) => {
                el.setAttribute("data-swiper-slide-index", String(index));
            });
        };
        const clearBlankSlides = () => {
            const slides = elementChildren(slidesEl, `.${params.slideBlankClass}`);
            slides.forEach(el => {
                el.remove();
            });
            if (slides.length > 0) {
                swiper.recalcSlides();
                swiper.updateSlides();
            }
        };
        const gridEnabled = swiper.grid && params.grid && params.grid.rows > 1;
        if (params.loopAddBlankSlides && (params.slidesPerGroup > 1 || gridEnabled)) clearBlankSlides();
        const slidesPerGroup = params.slidesPerGroup * (gridEnabled ? params.grid.rows : 1);
        const shouldFillGroup = swiper.slides.length % slidesPerGroup !== 0;
        const shouldFillGrid = gridEnabled && swiper.slides.length % params.grid.rows !== 0;
        const addBlankSlides = amountOfSlides => {
            for (let i = 0; i < amountOfSlides; i += 1) {
                const slideEl = swiper.isElement ? createElement("swiper-slide", [ params.slideBlankClass ]) : createElement("div", [ params.slideClass, params.slideBlankClass ]);
                swiper.slidesEl.append(slideEl);
            }
        };
        if (shouldFillGroup) {
            if (params.loopAddBlankSlides) {
                const slidesToAdd = slidesPerGroup - swiper.slides.length % slidesPerGroup;
                addBlankSlides(slidesToAdd);
                swiper.recalcSlides();
                swiper.updateSlides();
            } else showWarning("Swiper Loop Warning: The number of slides is not even to slidesPerGroup, loop mode may not function properly. You need to add more slides (or make duplicates, or empty slides)");
            initSlides();
        } else if (shouldFillGrid) {
            if (params.loopAddBlankSlides) {
                const slidesToAdd = params.grid.rows - swiper.slides.length % params.grid.rows;
                addBlankSlides(slidesToAdd);
                swiper.recalcSlides();
                swiper.updateSlides();
            } else showWarning("Swiper Loop Warning: The number of slides is not even to grid.rows, loop mode may not function properly. You need to add more slides (or make duplicates, or empty slides)");
            initSlides();
        } else initSlides();
        const bothDirections = params.centeredSlides || !!params.slidesOffsetBefore || !!params.slidesOffsetAfter;
        swiper.loopFix({
            slideRealIndex,
            direction: bothDirections ? void 0 : "next",
            initial
        });
    }
    function loopDestroy() {
        const swiper = this;
        const {params, slidesEl} = swiper;
        if (!params.loop || !slidesEl || swiper.virtual && swiper.params.virtual?.enabled) return;
        swiper.recalcSlides();
        const newSlidesOrder = [];
        swiper.slides.forEach(slideEl => {
            const loopSlideEl = slideEl;
            const index = typeof loopSlideEl.swiperSlideIndex === "undefined" ? Number(slideEl.getAttribute("data-swiper-slide-index")) : loopSlideEl.swiperSlideIndex;
            newSlidesOrder[index] = slideEl;
        });
        swiper.slides.forEach(slideEl => {
            slideEl.removeAttribute("data-swiper-slide-index");
        });
        newSlidesOrder.forEach(slideEl => {
            slidesEl.append(slideEl);
        });
        swiper.recalcSlides();
        swiper.slideTo(swiper.realIndex, 0);
    }
    function loopFix(options = {}) {
        const {slideRealIndex, slideTo = true, direction, setTranslate, activeSlideIndex: activeSlideIndexParam, initial, byController, byMousewheel} = options;
        let activeSlideIndex = activeSlideIndexParam;
        const swiper = this;
        if (!swiper.params.loop) return;
        swiper.emit("beforeLoopFix");
        const {slides, allowSlidePrev, allowSlideNext, slidesEl, params} = swiper;
        const {centeredSlides, slidesOffsetBefore, slidesOffsetAfter, initialSlide} = params;
        const bothDirections = centeredSlides || !!slidesOffsetBefore || !!slidesOffsetAfter;
        swiper.allowSlidePrev = true;
        swiper.allowSlideNext = true;
        if (swiper.virtual && params.virtual?.enabled) {
            if (slideTo) {
                const virtualSlidesLength = swiper.virtual.slides.length;
                const virtualSlidesBefore = swiper.virtual.slidesBefore ?? 0;
                if (!bothDirections && swiper.snapIndex === 0) swiper.slideTo(virtualSlidesLength, 0, false, true); else if (bothDirections && swiper.snapIndex < params.slidesPerView) swiper.slideTo(virtualSlidesLength + swiper.snapIndex, 0, false, true); else if (swiper.snapIndex === swiper.snapGrid.length - 1) swiper.slideTo(virtualSlidesBefore, 0, false, true);
            }
            swiper.allowSlidePrev = allowSlidePrev;
            swiper.allowSlideNext = allowSlideNext;
            swiper.emit("loopFix");
            return;
        }
        let slidesPerView = params.slidesPerView;
        if (slidesPerView === "auto") slidesPerView = swiper.slidesPerViewDynamic(); else {
            slidesPerView = Math.ceil(parseFloat(String(params.slidesPerView)));
            if (bothDirections && slidesPerView % 2 === 0) slidesPerView += 1;
        }
        const slidesPerGroup = params.slidesPerGroupAuto ? slidesPerView : params.slidesPerGroup;
        let loopedSlides = bothDirections ? Math.max(slidesPerGroup, Math.ceil(slidesPerView / 2)) : slidesPerGroup;
        if (loopedSlides % slidesPerGroup !== 0) loopedSlides += slidesPerGroup - loopedSlides % slidesPerGroup;
        loopedSlides += params.loopAdditionalSlides;
        swiper.loopedSlides = loopedSlides;
        const gridEnabled = swiper.grid && params.grid && params.grid.rows > 1;
        if (slides.length < slidesPerView + loopedSlides || swiper.params.effect === "cards" && slides.length < slidesPerView + loopedSlides * 2) showWarning("Swiper Loop Warning: The number of slides is not enough for loop mode, it will be disabled or not function properly. You need to add more slides (or make duplicates) or lower the values of slidesPerView and slidesPerGroup parameters"); else if (gridEnabled && params.grid.fill === "row") showWarning("Swiper Loop Warning: Loop mode is not compatible with grid.fill = `row`");
        const prependSlidesIndexes = [];
        const appendSlidesIndexes = [];
        const cols = gridEnabled ? Math.ceil(slides.length / params.grid.rows) : slides.length;
        const isInitialOverflow = initial && cols - initialSlide < slidesPerView && !bothDirections;
        let activeIndex = isInitialOverflow ? initialSlide : swiper.activeIndex;
        if (typeof activeSlideIndex === "undefined") activeSlideIndex = swiper.getSlideIndex(slides.find(el => el.classList.contains(params.slideActiveClass))); else activeIndex = activeSlideIndex;
        const isNext = direction === "next" || !direction;
        const isPrev = direction === "prev" || !direction;
        let slidesPrepended = 0;
        let slidesAppended = 0;
        const activeColIndex = gridEnabled ? slides[activeSlideIndex].column ?? 0 : activeSlideIndex;
        const activeColIndexWithShift = activeColIndex + (bothDirections && typeof setTranslate === "undefined" ? -slidesPerView / 2 + .5 : 0);
        if (activeColIndexWithShift < loopedSlides) {
            slidesPrepended = Math.max(loopedSlides - activeColIndexWithShift, slidesPerGroup);
            for (let i = 0; i < loopedSlides - activeColIndexWithShift; i += 1) {
                const index = i - Math.floor(i / cols) * cols;
                if (gridEnabled) {
                    const colIndexToPrepend = cols - index - 1;
                    for (let j = slides.length - 1; j >= 0; j -= 1) if (slides[j].column === colIndexToPrepend) prependSlidesIndexes.push(j);
                } else prependSlidesIndexes.push(cols - index - 1);
            }
        } else if (activeColIndexWithShift + slidesPerView > cols - loopedSlides) {
            slidesAppended = Math.max(activeColIndexWithShift - (cols - loopedSlides * 2), slidesPerGroup);
            if (isInitialOverflow) slidesAppended = Math.max(slidesAppended, slidesPerView - cols + initialSlide + 1);
            for (let i = 0; i < slidesAppended; i += 1) {
                const index = i - Math.floor(i / cols) * cols;
                if (gridEnabled) slides.forEach((slide, slideIndex) => {
                    if (slide.column === index) appendSlidesIndexes.push(slideIndex);
                }); else appendSlidesIndexes.push(index);
            }
        }
        swiper.__preventObserver__ = true;
        requestAnimationFrame(() => {
            swiper.__preventObserver__ = false;
        });
        if (swiper.params.effect === "cards" && slides.length < slidesPerView + loopedSlides * 2) {
            if (appendSlidesIndexes.includes(activeSlideIndex)) appendSlidesIndexes.splice(appendSlidesIndexes.indexOf(activeSlideIndex), 1);
            if (prependSlidesIndexes.includes(activeSlideIndex)) prependSlidesIndexes.splice(prependSlidesIndexes.indexOf(activeSlideIndex), 1);
        }
        if (isPrev) prependSlidesIndexes.forEach(index => {
            const slideEl = slides[index];
            slideEl.swiperLoopMoveDOM = true;
            slidesEl.prepend(slideEl);
            slideEl.swiperLoopMoveDOM = false;
        });
        if (isNext) appendSlidesIndexes.forEach(index => {
            const slideEl = slides[index];
            slideEl.swiperLoopMoveDOM = true;
            slidesEl.append(slideEl);
            slideEl.swiperLoopMoveDOM = false;
        });
        swiper.recalcSlides();
        if (params.slidesPerView === "auto") swiper.updateSlides(); else if (gridEnabled && (prependSlidesIndexes.length > 0 && isPrev || appendSlidesIndexes.length > 0 && isNext)) swiper.slides.forEach((slide, slideIndex) => {
            swiper.grid.updateSlide(slideIndex, slide, swiper.slides);
        });
        if (params.watchSlidesProgress) swiper.updateSlidesOffset();
        if (slideTo) if (prependSlidesIndexes.length > 0 && isPrev) {
            if (typeof slideRealIndex === "undefined") {
                const currentSlideTranslate = swiper.slidesGrid[activeIndex];
                const newSlideTranslate = swiper.slidesGrid[activeIndex + slidesPrepended];
                const diff = newSlideTranslate - currentSlideTranslate;
                if (byMousewheel) swiper.setTranslate(swiper.translate - diff); else {
                    swiper.slideTo(activeIndex + Math.ceil(slidesPrepended), 0, false, true);
                    if (setTranslate) {
                        swiper.touchEventsData.startTranslate = swiper.touchEventsData.startTranslate - diff;
                        swiper.touchEventsData.currentTranslate = swiper.touchEventsData.currentTranslate - diff;
                    }
                }
            } else if (setTranslate) {
                const shift = gridEnabled ? prependSlidesIndexes.length / params.grid.rows : prependSlidesIndexes.length;
                swiper.slideTo(swiper.activeIndex + shift, 0, false, true);
                swiper.touchEventsData.currentTranslate = swiper.translate;
            }
        } else if (appendSlidesIndexes.length > 0 && isNext) if (typeof slideRealIndex === "undefined") {
            const currentSlideTranslate = swiper.slidesGrid[activeIndex];
            const newSlideTranslate = swiper.slidesGrid[activeIndex - slidesAppended];
            const diff = newSlideTranslate - currentSlideTranslate;
            if (byMousewheel) swiper.setTranslate(swiper.translate - diff); else {
                swiper.slideTo(activeIndex - slidesAppended, 0, false, true);
                if (setTranslate) {
                    swiper.touchEventsData.startTranslate = swiper.touchEventsData.startTranslate - diff;
                    swiper.touchEventsData.currentTranslate = swiper.touchEventsData.currentTranslate - diff;
                }
            }
        } else {
            const shift = gridEnabled ? appendSlidesIndexes.length / params.grid.rows : appendSlidesIndexes.length;
            swiper.slideTo(swiper.activeIndex - shift, 0, false, true);
        }
        swiper.allowSlidePrev = allowSlidePrev;
        swiper.allowSlideNext = allowSlideNext;
        const controlled = swiper.controller?.control;
        if (controlled && !byController) {
            const loopParams = {
                slideRealIndex,
                direction,
                setTranslate,
                activeSlideIndex,
                byController: true
            };
            if (Array.isArray(controlled)) controlled.forEach(c => {
                if (!c.destroyed && c.params.loop) c.loopFix({
                    ...loopParams,
                    slideTo: c.params.slidesPerView === params.slidesPerView ? slideTo : false
                });
            }); else if (controlled instanceof swiper.constructor && controlled.params.loop) controlled.loopFix({
                ...loopParams,
                slideTo: controlled.params.slidesPerView === params.slidesPerView ? slideTo : false
            });
        }
        swiper.emit("loopFix");
    }
    var loop = {
        loopCreate,
        loopFix,
        loopDestroy
    };
    function moduleExtendParams(params, allModulesParams) {
        return function extendParams(obj = {}) {
            const moduleParamName = Object.keys(obj)[0];
            const moduleParams = obj[moduleParamName];
            if (typeof moduleParams !== "object" || moduleParams === null) {
                extend(allModulesParams, obj);
                return;
            }
            if (params[moduleParamName] === true) params[moduleParamName] = {
                enabled: true
            };
            if (moduleParamName === "navigation" && params[moduleParamName] && params[moduleParamName].enabled && !params[moduleParamName].prevEl && !params[moduleParamName].nextEl) params[moduleParamName].auto = true;
            if ([ "pagination", "scrollbar" ].indexOf(moduleParamName) >= 0 && params[moduleParamName] && params[moduleParamName].enabled && !params[moduleParamName].el) params[moduleParamName].auto = true;
            if (!(moduleParamName in params && "enabled" in moduleParams)) {
                extend(allModulesParams, obj);
                return;
            }
            if (typeof params[moduleParamName] === "object" && !("enabled" in params[moduleParamName])) params[moduleParamName].enabled = true;
            if (!params[moduleParamName]) params[moduleParamName] = {
                enabled: false
            };
            extend(allModulesParams, obj);
        };
    }
    const Observer = ({swiper, extendParams, on}) => {
        const observers = [];
        const attach = (target, options = {}) => {
            const ObserverFunc = window.MutationObserver || window.WebkitMutationObserver;
            if (!ObserverFunc) return;
            const observer = new ObserverFunc(mutations => {
                if (swiper.__preventObserver__) return;
                if (mutations.length === 1) {
                    swiper.emit("observerUpdate", mutations[0]);
                    return;
                }
                const observerUpdate = function observerUpdate() {
                    swiper.emit("observerUpdate", mutations[0]);
                };
                if (window.requestAnimationFrame) window.requestAnimationFrame(observerUpdate); else window.setTimeout(observerUpdate, 0);
            });
            observer.observe(target, {
                attributes: typeof options.attributes === "undefined" ? true : options.attributes,
                childList: swiper.isElement || (typeof options.childList === "undefined" ? true : options.childList),
                characterData: typeof options.characterData === "undefined" ? true : options.characterData
            });
            observers.push(observer);
        };
        const init = () => {
            if (!swiper.params.observer) return;
            if (swiper.params.observeParents) {
                const containerParents = elementParents(swiper.hostEl);
                for (let i = 0; i < containerParents.length; i += 1) attach(containerParents[i]);
            }
            attach(swiper.hostEl, {
                childList: swiper.params.observeSlideChildren
            });
            attach(swiper.wrapperEl, {
                attributes: false
            });
        };
        const destroy = () => {
            observers.forEach(observer => {
                observer.disconnect();
            });
            observers.splice(0, observers.length);
        };
        extendParams({
            observer: false,
            observeParents: false,
            observeSlideChildren: false
        });
        on("init", init);
        on("destroy", destroy);
    };
    const Resize = ({swiper, on, emit}) => {
        let observer = null;
        let animationFrame = null;
        const resizeHandler = () => {
            if (!swiper || swiper.destroyed || !swiper.initialized) return;
            emit("beforeResize");
            emit("resize");
        };
        const createObserver = () => {
            if (!swiper || swiper.destroyed || !swiper.initialized) return;
            observer = new ResizeObserver(entries => {
                animationFrame = window.requestAnimationFrame(() => {
                    const {width, height} = swiper;
                    let newWidth = width;
                    let newHeight = height;
                    entries.forEach(({contentBoxSize, contentRect, target}) => {
                        if (target && target !== swiper.el) return;
                        const box = Array.isArray(contentBoxSize) ? contentBoxSize[0] : contentBoxSize;
                        newWidth = contentRect ? contentRect.width : box.inlineSize;
                        newHeight = contentRect ? contentRect.height : box.blockSize;
                    });
                    if (newWidth !== width || newHeight !== height) resizeHandler();
                });
            });
            observer.observe(swiper.el);
        };
        const removeObserver = () => {
            if (animationFrame) window.cancelAnimationFrame(animationFrame);
            if (observer && observer.unobserve && swiper.el) {
                observer.unobserve(swiper.el);
                observer = null;
            }
        };
        const orientationChangeHandler = () => {
            if (!swiper || swiper.destroyed || !swiper.initialized) return;
            emit("orientationchange");
        };
        on("init", () => {
            if (swiper.params.resizeObserver && typeof window.ResizeObserver !== "undefined") {
                createObserver();
                return;
            }
            window.addEventListener("resize", resizeHandler);
            window.addEventListener("orientationchange", orientationChangeHandler);
        });
        on("destroy", () => {
            removeObserver();
            window.removeEventListener("resize", resizeHandler);
            window.removeEventListener("orientationchange", orientationChangeHandler);
        });
    };
    function slideNext(speed, runCallbacks = true, internal) {
        const swiper = this;
        const {enabled, params, animating} = swiper;
        if (!enabled || swiper.destroyed) return swiper;
        if (typeof speed === "undefined") speed = swiper.params.speed;
        let perGroup = params.slidesPerGroup;
        if (params.slidesPerView === "auto" && params.slidesPerGroup === 1 && params.slidesPerGroupAuto) perGroup = Math.max(swiper.slidesPerViewDynamic("current", true), 1);
        const increment = swiper.activeIndex < params.slidesPerGroupSkip ? 1 : perGroup;
        const isVirtual = swiper.virtual && params.virtual?.enabled;
        if (params.loop) {
            if (animating && !isVirtual && params.loopPreventsSliding) return false;
            swiper.loopFix({
                direction: "next"
            });
            swiper._clientLeft = swiper.wrapperEl.clientLeft;
            if (swiper.activeIndex === swiper.slides.length - 1 && params.cssMode) {
                requestAnimationFrame(() => {
                    swiper.slideTo(swiper.activeIndex + increment, speed, runCallbacks, internal);
                });
                return true;
            }
        }
        if (params.rewind && swiper.isEnd) return swiper.slideTo(0, speed, runCallbacks, internal);
        return swiper.slideTo(swiper.activeIndex + increment, speed, runCallbacks, internal);
    }
    function slidePrev(speed, runCallbacks = true, internal) {
        const swiper = this;
        const {params, snapGrid, slidesGrid, rtlTranslate, enabled, animating} = swiper;
        if (!enabled || swiper.destroyed) return swiper;
        if (typeof speed === "undefined") speed = swiper.params.speed;
        const isVirtual = swiper.virtual && params.virtual?.enabled;
        if (params.loop) {
            if (animating && !isVirtual && params.loopPreventsSliding) return false;
            swiper.loopFix({
                direction: "prev"
            });
            swiper._clientLeft = swiper.wrapperEl.clientLeft;
        }
        const translate = rtlTranslate ? swiper.translate : -swiper.translate;
        function normalize(val) {
            if (val < 0) return -Math.floor(Math.abs(val));
            return Math.floor(val);
        }
        const normalizedTranslate = normalize(translate);
        const normalizedSnapGrid = snapGrid.map(val => normalize(val));
        const isFreeMode = params.freeMode && params.freeMode.enabled;
        let prevSnap = snapGrid[normalizedSnapGrid.indexOf(normalizedTranslate) - 1];
        if (typeof prevSnap === "undefined" && (params.cssMode || isFreeMode)) {
            let prevSnapIndex;
            snapGrid.forEach((snap, snapIndex) => {
                if (normalizedTranslate >= snap) prevSnapIndex = snapIndex;
            });
            if (typeof prevSnapIndex !== "undefined") prevSnap = isFreeMode ? snapGrid[prevSnapIndex] : snapGrid[prevSnapIndex > 0 ? prevSnapIndex - 1 : prevSnapIndex];
        }
        let prevIndex = 0;
        if (typeof prevSnap !== "undefined") {
            prevIndex = slidesGrid.indexOf(prevSnap);
            if (prevIndex < 0) prevIndex = swiper.activeIndex - 1;
            if (params.slidesPerView === "auto" && params.slidesPerGroup === 1 && params.slidesPerGroupAuto) {
                prevIndex = prevIndex - swiper.slidesPerViewDynamic("previous", true) + 1;
                prevIndex = Math.max(prevIndex, 0);
            }
        }
        if (params.rewind && swiper.isBeginning) {
            const lastIndex = swiper.params.virtual?.enabled && swiper.virtual ? swiper.virtual.slides.length - 1 : swiper.slides.length - 1;
            return swiper.slideTo(lastIndex, speed, runCallbacks, internal);
        } else if (params.loop && swiper.activeIndex === 0 && params.cssMode) {
            requestAnimationFrame(() => {
                swiper.slideTo(prevIndex, speed, runCallbacks, internal);
            });
            return true;
        }
        return swiper.slideTo(prevIndex, speed, runCallbacks, internal);
    }
    function slideReset(speed, runCallbacks = true, internal) {
        const swiper = this;
        if (swiper.destroyed) return;
        if (typeof speed === "undefined") speed = swiper.params.speed;
        return swiper.slideTo(swiper.activeIndex, speed, runCallbacks, internal);
    }
    function slideTo(index = 0, speed, runCallbacks = true, internal, initial) {
        if (typeof index === "string") index = parseInt(index, 10);
        const swiper = this;
        let slideIndex = index;
        if (slideIndex < 0) slideIndex = 0;
        const {params, snapGrid, slidesGrid, previousIndex, activeIndex, rtlTranslate: rtl, wrapperEl, enabled} = swiper;
        if (!enabled && !internal && !initial || swiper.destroyed || swiper.animating && params.preventInteractionOnTransition) return false;
        if (typeof speed === "undefined") speed = swiper.params.speed;
        const skip = Math.min(swiper.params.slidesPerGroupSkip, slideIndex);
        let snapIndex = skip + Math.floor((slideIndex - skip) / swiper.params.slidesPerGroup);
        if (snapIndex >= snapGrid.length) snapIndex = snapGrid.length - 1;
        const translate = -snapGrid[snapIndex];
        if (params.normalizeSlideIndex) for (let i = 0; i < slidesGrid.length; i += 1) {
            const normalizedTranslate = -Math.floor(translate * 100);
            const normalizedGrid = Math.floor(slidesGrid[i] * 100);
            const normalizedGridNext = Math.floor(slidesGrid[i + 1] * 100);
            if (typeof slidesGrid[i + 1] !== "undefined") {
                if (normalizedTranslate >= normalizedGrid && normalizedTranslate < normalizedGridNext - (normalizedGridNext - normalizedGrid) / 2) slideIndex = i; else if (normalizedTranslate >= normalizedGrid && normalizedTranslate < normalizedGridNext) slideIndex = i + 1;
            } else if (normalizedTranslate >= normalizedGrid) slideIndex = i;
        }
        if (swiper.initialized && slideIndex !== activeIndex) {
            if (!swiper.allowSlideNext && (rtl ? translate > swiper.translate && translate > swiper.minTranslate() : translate < swiper.translate && translate < swiper.minTranslate())) return false;
            if (!swiper.allowSlidePrev && translate > swiper.translate && translate > swiper.maxTranslate()) if ((activeIndex || 0) !== slideIndex) return false;
        }
        if (slideIndex !== (previousIndex || 0) && runCallbacks) swiper.emit("beforeSlideChangeStart");
        swiper.updateProgress(translate);
        let direction;
        if (slideIndex > activeIndex) direction = "next"; else if (slideIndex < activeIndex) direction = "prev"; else direction = "reset";
        const isVirtual = swiper.virtual && swiper.params.virtual?.enabled;
        const isInitialVirtual = isVirtual && initial;
        if (!isInitialVirtual && (rtl && -translate === swiper.translate || !rtl && translate === swiper.translate)) {
            swiper.updateActiveIndex(slideIndex);
            if (params.autoHeight) swiper.updateAutoHeight();
            swiper.updateSlidesClasses();
            if (params.effect !== "slide") swiper.setTranslate(translate);
            if (direction !== "reset") {
                swiper.transitionStart(runCallbacks, direction);
                swiper.transitionEnd(runCallbacks, direction);
            }
            return false;
        }
        if (params.cssMode) {
            const isH = swiper.isHorizontal();
            const t = rtl ? translate : -translate;
            if (speed === 0) {
                if (isVirtual) {
                    swiper.wrapperEl.style.scrollSnapType = "none";
                    swiper._immediateVirtual = true;
                }
                if (isVirtual && !swiper._cssModeVirtualInitialSet && (swiper.params.initialSlide ?? 0) > 0) {
                    swiper._cssModeVirtualInitialSet = true;
                    requestAnimationFrame(() => {
                        wrapperEl[isH ? "scrollLeft" : "scrollTop"] = t;
                    });
                } else wrapperEl[isH ? "scrollLeft" : "scrollTop"] = t;
                if (isVirtual) requestAnimationFrame(() => {
                    swiper.wrapperEl.style.scrollSnapType = "";
                    swiper._immediateVirtual = false;
                });
            } else wrapperEl.scrollTo({
                [isH ? "left" : "top"]: t,
                behavior: "smooth"
            });
            return true;
        }
        const browser = getBrowser();
        const isSafari = browser.isSafari;
        if (isVirtual && !initial && isSafari && swiper.isElement) swiper.virtual.update(false, false, slideIndex);
        swiper.setTransition(speed);
        swiper.setTranslate(translate);
        swiper.updateActiveIndex(slideIndex);
        swiper.updateSlidesClasses();
        swiper.emit("beforeTransitionStart", speed, internal);
        swiper.transitionStart(runCallbacks, direction);
        if (speed === 0) swiper.transitionEnd(runCallbacks, direction); else if (!swiper.animating) {
            swiper.animating = true;
            if (!swiper.onSlideToWrapperTransitionEnd) swiper.onSlideToWrapperTransitionEnd = function transitionEnd(e) {
                if (!swiper || swiper.destroyed) return;
                if (e.target !== this) return;
                swiper.wrapperEl.removeEventListener("transitionend", swiper.onSlideToWrapperTransitionEnd);
                swiper.onSlideToWrapperTransitionEnd = null;
                delete swiper.onSlideToWrapperTransitionEnd;
                swiper.transitionEnd(runCallbacks, direction);
            };
            swiper.wrapperEl.addEventListener("transitionend", swiper.onSlideToWrapperTransitionEnd);
        }
        return true;
    }
    function slideToClickedSlide() {
        const swiper = this;
        if (swiper.destroyed) return;
        const {params, slidesEl, clickedSlide, clickedIndex} = swiper;
        if (clickedSlide === void 0 || clickedIndex === void 0) return;
        const slidesPerView = params.slidesPerView === "auto" ? swiper.slidesPerViewDynamic() : params.slidesPerView;
        let slideToIndex = swiper.getSlideIndexWhenGrid(clickedIndex);
        let realIndex;
        const slideSelector = swiper.isElement ? `swiper-slide` : `.${params.slideClass}`;
        const isGrid = swiper.grid && swiper.params.grid && swiper.params.grid.rows > 1;
        if (params.loop) {
            if (swiper.animating) return;
            realIndex = parseInt(clickedSlide.getAttribute("data-swiper-slide-index"), 10);
            if (params.centeredSlides) swiper.slideToLoop(realIndex); else if (slideToIndex > (isGrid ? (swiper.slides.length - slidesPerView) / 2 - (swiper.params.grid.rows - 1) : swiper.slides.length - slidesPerView)) {
                swiper.loopFix();
                slideToIndex = swiper.getSlideIndex(elementChildren(slidesEl, `${slideSelector}[data-swiper-slide-index="${realIndex}"]`)[0]);
                nextTick(() => {
                    swiper.slideTo(slideToIndex);
                });
            } else swiper.slideTo(slideToIndex);
        } else swiper.slideTo(slideToIndex);
    }
    function slideToClosest(speed, runCallbacks = true, internal, threshold = .5) {
        const swiper = this;
        if (swiper.destroyed) return;
        if (typeof speed === "undefined") speed = swiper.params.speed;
        let index = swiper.activeIndex;
        const skip = Math.min(swiper.params.slidesPerGroupSkip, index);
        const snapIndex = skip + Math.floor((index - skip) / swiper.params.slidesPerGroup);
        const translate = swiper.rtlTranslate ? swiper.translate : -swiper.translate;
        if (translate >= swiper.snapGrid[snapIndex]) {
            const currentSnap = swiper.snapGrid[snapIndex];
            const nextSnap = swiper.snapGrid[snapIndex + 1];
            if (translate - currentSnap > (nextSnap - currentSnap) * threshold) index += swiper.params.slidesPerGroup;
        } else {
            const prevSnap = swiper.snapGrid[snapIndex - 1];
            const currentSnap = swiper.snapGrid[snapIndex];
            if (translate - prevSnap <= (currentSnap - prevSnap) * threshold) index -= swiper.params.slidesPerGroup;
        }
        index = Math.max(index, 0);
        index = Math.min(index, swiper.slidesGrid.length - 1);
        return swiper.slideTo(index, speed, runCallbacks, internal);
    }
    function slideToLoop(index = 0, speed, runCallbacks = true, internal) {
        if (typeof index === "string") {
            const indexAsNumber = parseInt(index, 10);
            index = indexAsNumber;
        }
        const swiper = this;
        if (swiper.destroyed) return;
        if (typeof speed === "undefined") speed = swiper.params.speed;
        const gridEnabled = swiper.grid && swiper.params.grid && swiper.params.grid.rows > 1;
        let newIndex = index;
        if (swiper.params.loop) if (swiper.virtual && swiper.params.virtual?.enabled) newIndex += swiper.virtual.slidesBefore ?? 0; else {
            let targetSlideIndex;
            if (gridEnabled) {
                const slideIndex = newIndex * swiper.params.grid.rows;
                const targetSlideEl = swiper.slides.find(slideEl => Number(slideEl.getAttribute("data-swiper-slide-index")) === slideIndex);
                targetSlideIndex = targetSlideEl?.column ?? 0;
            } else targetSlideIndex = swiper.getSlideIndexByData(newIndex);
            const cols = gridEnabled ? Math.ceil(swiper.slides.length / swiper.params.grid.rows) : swiper.slides.length;
            const {centeredSlides, slidesOffsetBefore, slidesOffsetAfter} = swiper.params;
            const bothDirections = centeredSlides || !!slidesOffsetBefore || !!slidesOffsetAfter;
            let slidesPerView;
            if (swiper.params.slidesPerView === "auto") slidesPerView = swiper.slidesPerViewDynamic(); else {
                slidesPerView = Math.ceil(parseFloat(String(swiper.params.slidesPerView)));
                if (bothDirections && slidesPerView % 2 === 0) slidesPerView += 1;
            }
            let needLoopFix = cols - targetSlideIndex < slidesPerView;
            if (bothDirections) needLoopFix = needLoopFix || targetSlideIndex < Math.ceil(slidesPerView / 2);
            if (internal && bothDirections && swiper.params.slidesPerView !== "auto" && !gridEnabled) needLoopFix = false;
            if (needLoopFix) {
                const direction = bothDirections ? targetSlideIndex < swiper.activeIndex ? "prev" : "next" : targetSlideIndex - swiper.activeIndex - 1 < swiper.params.slidesPerView ? "next" : "prev";
                swiper.loopFix({
                    direction,
                    slideTo: true,
                    activeSlideIndex: direction === "next" ? targetSlideIndex + 1 : targetSlideIndex - cols + 1,
                    slideRealIndex: direction === "next" ? swiper.realIndex : void 0
                });
            }
            if (gridEnabled) {
                const slideIndex = newIndex * swiper.params.grid.rows;
                const targetSlideEl = swiper.slides.find(slideEl => Number(slideEl.getAttribute("data-swiper-slide-index")) === slideIndex);
                newIndex = targetSlideEl?.column ?? 0;
            } else newIndex = swiper.getSlideIndexByData(newIndex);
        }
        requestAnimationFrame(() => {
            swiper.slideTo(newIndex, speed, runCallbacks, internal);
        });
        return swiper;
    }
    var slide = {
        slideTo,
        slideToLoop,
        slideNext,
        slidePrev,
        slideReset,
        slideToClosest,
        slideToClickedSlide
    };
    function setTransition(duration, byController) {
        const swiper = this;
        if (!swiper.params.cssMode) {
            swiper.wrapperEl.style.transitionDuration = `${duration}ms`;
            swiper.wrapperEl.style.transitionDelay = duration === 0 ? `0ms` : "";
        }
        swiper.emit("setTransition", duration, byController);
    }
    function transitionEmit({swiper, runCallbacks, direction, step}) {
        const {activeIndex, previousIndex} = swiper;
        let dir = direction;
        if (!dir) if (activeIndex > previousIndex) dir = "next"; else if (activeIndex < previousIndex) dir = "prev"; else dir = "reset";
        swiper.emit(`transition${step}`);
        if (runCallbacks && dir === "reset") swiper.emit(`slideResetTransition${step}`); else if (runCallbacks && activeIndex !== previousIndex) {
            swiper.emit(`slideChangeTransition${step}`);
            if (dir === "next") swiper.emit(`slideNextTransition${step}`); else swiper.emit(`slidePrevTransition${step}`);
        }
    }
    function transitionEnd(runCallbacks = true, direction) {
        const swiper = this;
        const {params} = swiper;
        swiper.animating = false;
        if (params.cssMode) return;
        swiper.setTransition(0);
        transitionEmit({
            swiper,
            runCallbacks,
            direction,
            step: "End"
        });
    }
    function transitionStart(runCallbacks = true, direction) {
        const swiper = this;
        const {params} = swiper;
        if (params.cssMode) return;
        if (params.autoHeight) swiper.updateAutoHeight();
        transitionEmit({
            swiper,
            runCallbacks,
            direction,
            step: "Start"
        });
    }
    var transition = {
        setTransition,
        transitionStart,
        transitionEnd
    };
    function getSwiperTranslate(axis = (this.isHorizontal() ? "x" : "y")) {
        const swiper = this;
        const {params, rtlTranslate: rtl, translate, wrapperEl} = swiper;
        if (params.virtualTranslate) return rtl ? -translate : translate;
        if (params.cssMode) return translate;
        let currentTranslate = getTranslate(wrapperEl, axis);
        currentTranslate += swiper.cssOverflowAdjustment();
        if (rtl) currentTranslate = -currentTranslate;
        return currentTranslate || 0;
    }
    function maxTranslate() {
        return -this.snapGrid[this.snapGrid.length - 1];
    }
    function minTranslate() {
        return -this.snapGrid[0];
    }
    function setTranslate(translate, byController) {
        const swiper = this;
        const {rtlTranslate: rtl, params, wrapperEl, progress} = swiper;
        let x = 0;
        let y = 0;
        const z = 0;
        if (swiper.isHorizontal()) x = rtl ? -translate : translate; else y = translate;
        if (params.roundLengths) {
            x = Math.floor(x);
            y = Math.floor(y);
        }
        swiper.previousTranslate = swiper.translate;
        swiper.translate = swiper.isHorizontal() ? x : y;
        if (params.cssMode) wrapperEl[swiper.isHorizontal() ? "scrollLeft" : "scrollTop"] = swiper.isHorizontal() ? -x : -y; else if (!params.virtualTranslate) {
            if (swiper.isHorizontal()) x -= swiper.cssOverflowAdjustment(); else y -= swiper.cssOverflowAdjustment();
            wrapperEl.style.transform = `translate3d(${x}px, ${y}px, ${z}px)`;
        }
        let newProgress;
        const translatesDiff = swiper.maxTranslate() - swiper.minTranslate();
        if (translatesDiff === 0) newProgress = 0; else newProgress = (translate - swiper.minTranslate()) / translatesDiff;
        if (newProgress !== progress) swiper.updateProgress(translate);
        swiper.emit("setTranslate", swiper.translate, byController);
    }
    function translateTo(translate = 0, speed = this.params.speed, runCallbacks = true, translateBounds = true, internal) {
        const swiper = this;
        const {params, wrapperEl} = swiper;
        if (swiper.animating && params.preventInteractionOnTransition) return false;
        const minTranslate = swiper.minTranslate();
        const maxTranslate = swiper.maxTranslate();
        let newTranslate;
        if (translateBounds && translate > minTranslate) newTranslate = minTranslate; else if (translateBounds && translate < maxTranslate) newTranslate = maxTranslate; else newTranslate = translate;
        swiper.updateProgress(newTranslate);
        if (params.cssMode) {
            const isH = swiper.isHorizontal();
            if (speed === 0) wrapperEl[isH ? "scrollLeft" : "scrollTop"] = -newTranslate; else wrapperEl.scrollTo({
                [isH ? "left" : "top"]: -newTranslate,
                behavior: "smooth"
            });
            return true;
        }
        if (speed === 0) {
            swiper.setTransition(0);
            swiper.setTranslate(newTranslate);
            if (runCallbacks) {
                swiper.emit("beforeTransitionStart", speed, internal);
                swiper.emit("transitionEnd");
            }
        } else {
            swiper.setTransition(speed);
            swiper.setTranslate(newTranslate);
            if (runCallbacks) {
                swiper.emit("beforeTransitionStart", speed, internal);
                swiper.emit("transitionStart");
            }
            if (!swiper.animating) {
                swiper.animating = true;
                if (!swiper.onTranslateToWrapperTransitionEnd) swiper.onTranslateToWrapperTransitionEnd = function transitionEnd(e) {
                    if (!swiper || swiper.destroyed) return;
                    if (e.target !== this) return;
                    swiper.wrapperEl.removeEventListener("transitionend", swiper.onTranslateToWrapperTransitionEnd);
                    swiper.onTranslateToWrapperTransitionEnd = null;
                    delete swiper.onTranslateToWrapperTransitionEnd;
                    swiper.animating = false;
                    if (runCallbacks) swiper.emit("transitionEnd");
                };
                swiper.wrapperEl.addEventListener("transitionend", swiper.onTranslateToWrapperTransitionEnd);
            }
        }
        return true;
    }
    var translate = {
        getTranslate: getSwiperTranslate,
        setTranslate,
        minTranslate,
        maxTranslate,
        translateTo
    };
    function getActiveIndexByTranslate(swiper) {
        const {slidesGrid, params} = swiper;
        const translate = swiper.rtlTranslate ? swiper.translate : -swiper.translate;
        let activeIndex;
        for (let i = 0; i < slidesGrid.length; i += 1) if (typeof slidesGrid[i + 1] !== "undefined") {
            if (translate >= slidesGrid[i] && translate < slidesGrid[i + 1] - (slidesGrid[i + 1] - slidesGrid[i]) / 2) activeIndex = i; else if (translate >= slidesGrid[i] && translate < slidesGrid[i + 1]) activeIndex = i + 1;
        } else if (translate >= slidesGrid[i]) activeIndex = i;
        if (params.normalizeSlideIndex) if (activeIndex < 0 || typeof activeIndex === "undefined") activeIndex = 0;
        return activeIndex;
    }
    function updateActiveIndex(newActiveIndex) {
        const swiper = this;
        const translate = swiper.rtlTranslate ? swiper.translate : -swiper.translate;
        const {snapGrid, params, activeIndex: previousIndex, realIndex: previousRealIndex, snapIndex: previousSnapIndex} = swiper;
        let activeIndex = newActiveIndex;
        let snapIndex;
        const getVirtualRealIndex = aIndex => {
            const virtualSlides = swiper.virtual.slides;
            let realIndex = aIndex - (swiper.virtual.slidesBefore ?? 0);
            if (realIndex < 0) realIndex = virtualSlides.length + realIndex;
            if (realIndex >= virtualSlides.length) realIndex -= virtualSlides.length;
            return realIndex;
        };
        if (typeof activeIndex === "undefined") activeIndex = getActiveIndexByTranslate(swiper);
        if (snapGrid.indexOf(translate) >= 0) snapIndex = snapGrid.indexOf(translate); else {
            const skip = Math.min(params.slidesPerGroupSkip, activeIndex);
            snapIndex = skip + Math.floor((activeIndex - skip) / params.slidesPerGroup);
        }
        if (snapIndex >= snapGrid.length) snapIndex = snapGrid.length - 1;
        if (activeIndex === previousIndex && !swiper.params.loop) {
            if (snapIndex !== previousSnapIndex) {
                swiper.snapIndex = snapIndex;
                swiper.emit("snapIndexChange");
            }
            return;
        }
        if (activeIndex === previousIndex && swiper.params.loop && swiper.virtual && swiper.params.virtual?.enabled) {
            swiper.realIndex = getVirtualRealIndex(activeIndex);
            return;
        }
        const gridEnabled = swiper.grid && params.grid && params.grid.rows > 1;
        let realIndex;
        if (swiper.virtual && params.virtual?.enabled) if (params.loop) realIndex = getVirtualRealIndex(activeIndex); else realIndex = activeIndex; else if (gridEnabled) {
            const firstSlideInColumn = swiper.slides.find(slideEl => slideEl.column === activeIndex);
            let activeSlideIndex = parseInt(firstSlideInColumn.getAttribute("data-swiper-slide-index"), 10);
            if (Number.isNaN(activeSlideIndex)) activeSlideIndex = Math.max(swiper.slides.indexOf(firstSlideInColumn), 0);
            realIndex = Math.floor(activeSlideIndex / params.grid.rows);
        } else if (swiper.slides[activeIndex]) {
            const slideIndex = swiper.slides[activeIndex].getAttribute("data-swiper-slide-index");
            if (slideIndex) realIndex = parseInt(slideIndex, 10); else realIndex = activeIndex;
        } else realIndex = activeIndex;
        Object.assign(swiper, {
            previousSnapIndex,
            snapIndex,
            previousRealIndex,
            realIndex,
            previousIndex,
            activeIndex
        });
        if (swiper.initialized) preload(swiper);
        swiper.emit("activeIndexChange");
        swiper.emit("snapIndexChange");
        if (swiper.initialized || swiper.params.runCallbacksOnInit) {
            if (previousRealIndex !== realIndex) swiper.emit("realIndexChange");
            swiper.emit("slideChange");
        }
    }
    function updateAutoHeight(speed) {
        const swiper = this;
        const activeSlides = [];
        const isVirtual = swiper.virtual && swiper.params.virtual?.enabled;
        let newHeight = 0;
        let i;
        if (typeof speed === "number") swiper.setTransition(speed); else if (speed === true) swiper.setTransition(swiper.params.speed);
        const getSlideByIndex = index => {
            if (isVirtual) return swiper.slides[swiper.getSlideIndexByData(index)];
            return swiper.slides[index];
        };
        if (swiper.params.slidesPerView !== "auto" && swiper.params.slidesPerView > 1) if (swiper.params.centeredSlides) (swiper.visibleSlides || []).forEach(slide => {
            activeSlides.push(slide);
        }); else for (i = 0; i < Math.ceil(swiper.params.slidesPerView); i += 1) {
            const index = swiper.activeIndex + i;
            if (index > swiper.slides.length && !isVirtual) break;
            const slide = getSlideByIndex(index);
            if (slide) activeSlides.push(slide);
        } else {
            const slide = getSlideByIndex(swiper.activeIndex);
            if (slide) activeSlides.push(slide);
        }
        for (i = 0; i < activeSlides.length; i += 1) if (typeof activeSlides[i] !== "undefined") {
            const height = activeSlides[i].offsetHeight;
            newHeight = height > newHeight ? height : newHeight;
        }
        if (newHeight || newHeight === 0) swiper.wrapperEl.style.height = `${newHeight}px`;
    }
    function updateClickedSlide(el, path) {
        const swiper = this;
        const params = swiper.params;
        let slide = el.closest(`.${params.slideClass}, swiper-slide`);
        if (!slide && swiper.isElement && path && path.length > 1 && path.includes(el)) [ ...path.slice(path.indexOf(el) + 1, path.length) ].forEach(pathEl => {
            if (!slide && pathEl.matches && pathEl.matches(`.${params.slideClass}, swiper-slide`)) slide = pathEl;
        });
        let slideFound = false;
        let slideIndex;
        if (slide) for (let i = 0; i < swiper.slides.length; i += 1) if (swiper.slides[i] === slide) {
            slideFound = true;
            slideIndex = i;
            break;
        }
        if (slide && slideFound) {
            swiper.clickedSlide = slide;
            if (swiper.virtual && swiper.params.virtual?.enabled) swiper.clickedIndex = parseInt(slide.getAttribute("data-swiper-slide-index"), 10); else swiper.clickedIndex = slideIndex;
        } else {
            swiper.clickedSlide = void 0;
            swiper.clickedIndex = void 0;
            return;
        }
        if (params.slideToClickedSlide && swiper.clickedIndex !== void 0 && swiper.clickedIndex !== swiper.activeIndex) swiper.slideToClickedSlide();
    }
    function updateProgress(translate) {
        const swiper = this;
        if (typeof translate === "undefined") {
            const multiplier = swiper.rtlTranslate ? -1 : 1;
            translate = swiper && swiper.translate && swiper.translate * multiplier || 0;
        }
        const params = swiper.params;
        const translatesDiff = swiper.maxTranslate() - swiper.minTranslate();
        let {progress, isBeginning, isEnd} = swiper;
        let progressLoop = swiper.progressLoop;
        const wasBeginning = isBeginning;
        const wasEnd = isEnd;
        if (translatesDiff === 0) {
            progress = 0;
            isBeginning = true;
            isEnd = true;
        } else {
            progress = (translate - swiper.minTranslate()) / translatesDiff;
            const isBeginningRounded = Math.abs(translate - swiper.minTranslate()) < 1;
            const isEndRounded = Math.abs(translate - swiper.maxTranslate()) < 1;
            isBeginning = isBeginningRounded || progress <= 0;
            isEnd = isEndRounded || progress >= 1;
            if (isBeginningRounded) progress = 0;
            if (isEndRounded) progress = 1;
        }
        if (params.loop) {
            const firstSlideIndex = swiper.getSlideIndexByData(0);
            const lastSlideIndex = swiper.getSlideIndexByData(swiper.slides.length - 1);
            const firstSlideTranslate = swiper.slidesGrid[firstSlideIndex];
            const lastSlideTranslate = swiper.slidesGrid[lastSlideIndex];
            const translateMax = swiper.slidesGrid[swiper.slidesGrid.length - 1];
            const translateAbs = Math.abs(translate);
            if (translateAbs >= firstSlideTranslate) progressLoop = (translateAbs - firstSlideTranslate) / translateMax; else progressLoop = (translateAbs + translateMax - lastSlideTranslate) / translateMax;
            if (progressLoop > 1) progressLoop -= 1;
        }
        Object.assign(swiper, {
            progress,
            progressLoop,
            isBeginning,
            isEnd
        });
        if (params.watchSlidesProgress || params.centeredSlides && params.autoHeight) swiper.updateSlidesProgress(translate);
        if (isBeginning && !wasBeginning) swiper.emit("reachBeginning toEdge");
        if (isEnd && !wasEnd) swiper.emit("reachEnd toEdge");
        if (wasBeginning && !isBeginning || wasEnd && !isEnd) swiper.emit("fromEdge");
        swiper.emit("progress", progress);
    }
    function updateSize() {
        const swiper = this;
        let width;
        let height;
        const el = swiper.el;
        if (typeof swiper.params.width !== "undefined" && swiper.params.width !== null) width = swiper.params.width; else width = el.clientWidth;
        if (typeof swiper.params.height !== "undefined" && swiper.params.height !== null) height = swiper.params.height; else height = el.clientHeight;
        if (width === 0 && swiper.isHorizontal() || height === 0 && swiper.isVertical()) return;
        width = width - parseInt(elementStyle(el, "padding-left") || "0", 10) - parseInt(elementStyle(el, "padding-right") || "0", 10);
        height = height - parseInt(elementStyle(el, "padding-top") || "0", 10) - parseInt(elementStyle(el, "padding-bottom") || "0", 10);
        if (Number.isNaN(width)) width = 0;
        if (Number.isNaN(height)) height = 0;
        Object.assign(swiper, {
            width,
            height,
            size: swiper.isHorizontal() ? width : height
        });
    }
    function updateSlides() {
        const swiper = this;
        function getDirectionPropertyValue(node, label) {
            return parseFloat(node.getPropertyValue(swiper.getDirectionLabel(label)) || "0");
        }
        const params = swiper.params;
        const {wrapperEl, slidesEl, rtlTranslate: rtl, wrongRTL} = swiper;
        const isVirtual = !!(swiper.virtual && params.virtual?.enabled);
        const previousSlidesLength = isVirtual ? swiper.virtual.slides.length : swiper.slides.length;
        const slides = elementChildren(slidesEl, `.${swiper.params.slideClass}, swiper-slide`);
        const slidesLength = isVirtual ? swiper.virtual.slides.length : slides.length;
        let snapGrid = [];
        const slidesGrid = [];
        const slidesSizesGrid = [];
        const resolveOffset = value => typeof value === "function" ? value.call(swiper) : value;
        const offsetBefore = resolveOffset(params.slidesOffsetBefore);
        const offsetAfter = resolveOffset(params.slidesOffsetAfter);
        const previousSnapGridLength = swiper.snapGrid.length;
        const previousSlidesGridLength = swiper.slidesGrid.length;
        const swiperSize = swiper.size - offsetBefore - offsetAfter;
        let spaceBetween = params.spaceBetween;
        let slidePosition = -offsetBefore;
        let prevSlideSize = 0;
        let index = 0;
        if (typeof swiperSize === "undefined") return;
        if (typeof spaceBetween === "string" && spaceBetween.indexOf("%") >= 0) spaceBetween = parseFloat(spaceBetween.replace("%", "")) / 100 * swiperSize; else if (typeof spaceBetween === "string") spaceBetween = parseFloat(spaceBetween);
        swiper.virtualSize = -spaceBetween - offsetBefore - offsetAfter;
        slides.forEach(slideEl => {
            if (rtl) slideEl.style.marginLeft = ""; else slideEl.style.marginRight = "";
            slideEl.style.marginBottom = "";
            slideEl.style.marginTop = "";
        });
        if (params.centeredSlides && params.cssMode) {
            setCSSProperty(wrapperEl, "--swiper-centered-offset-before", "");
            setCSSProperty(wrapperEl, "--swiper-centered-offset-after", "");
        }
        if (params.cssMode) {
            setCSSProperty(wrapperEl, "--swiper-slides-offset-before", `${offsetBefore}px`);
            setCSSProperty(wrapperEl, "--swiper-slides-offset-after", `${offsetAfter}px`);
        }
        const gridEnabled = params.grid && params.grid.rows > 1 && swiper.grid;
        if (gridEnabled) swiper.grid.initSlides(slides); else if (swiper.grid) swiper.grid.unsetSlides();
        let slideSize = 0;
        const shouldResetSlideSize = params.slidesPerView === "auto" && params.breakpoints && Object.keys(params.breakpoints).filter(key => {
            const bp = params.breakpoints[key];
            return typeof bp?.slidesPerView !== "undefined";
        }).length > 0;
        for (let i = 0; i < slidesLength; i += 1) {
            slideSize = 0;
            const slide = slides[i];
            if (slide) {
                if (gridEnabled) swiper.grid.updateSlide(i, slide, slides);
                if (elementStyle(slide, "display") === "none") continue;
            }
            if (isVirtual && params.slidesPerView === "auto") {
                if (params.virtual?.slidesPerViewAutoSlideSize) slideSize = params.virtual.slidesPerViewAutoSlideSize;
                if (slideSize && slide) {
                    if (params.roundLengths) slideSize = Math.floor(slideSize);
                    slide.style[swiper.getDirectionLabel("width")] = `${slideSize}px`;
                }
            } else if (params.slidesPerView === "auto") {
                if (shouldResetSlideSize) slide.style[swiper.getDirectionLabel("width")] = ``;
                const slideStyles = getComputedStyle(slide);
                const currentTransform = slide.style.transform;
                const currentWebKitTransform = slide.style.webkitTransform;
                if (currentTransform) slide.style.transform = "none";
                if (currentWebKitTransform) slide.style.webkitTransform = "none";
                if (params.roundLengths) slideSize = swiper.isHorizontal() ? elementOuterSize(slide, "width") : elementOuterSize(slide, "height"); else {
                    const width = getDirectionPropertyValue(slideStyles, "width");
                    const paddingLeft = getDirectionPropertyValue(slideStyles, "padding-left");
                    const paddingRight = getDirectionPropertyValue(slideStyles, "padding-right");
                    const marginLeft = getDirectionPropertyValue(slideStyles, "margin-left");
                    const marginRight = getDirectionPropertyValue(slideStyles, "margin-right");
                    const boxSizing = slideStyles.getPropertyValue("box-sizing");
                    if (boxSizing && boxSizing === "border-box") slideSize = width + marginLeft + marginRight; else {
                        const {clientWidth, offsetWidth} = slide;
                        slideSize = width + paddingLeft + paddingRight + marginLeft + marginRight + (offsetWidth - clientWidth);
                    }
                }
                if (currentTransform) slide.style.transform = currentTransform;
                if (currentWebKitTransform) slide.style.webkitTransform = currentWebKitTransform;
                if (params.roundLengths) slideSize = Math.floor(slideSize);
            } else {
                slideSize = (swiperSize - (params.slidesPerView - 1) * spaceBetween) / params.slidesPerView;
                if (params.roundLengths) slideSize = Math.floor(slideSize);
                if (slide) slide.style[swiper.getDirectionLabel("width")] = `${slideSize}px`;
            }
            if (slide) slide.swiperSlideSize = slideSize;
            slidesSizesGrid.push(slideSize);
            if (params.centeredSlides) {
                slidePosition = slidePosition + slideSize / 2 + prevSlideSize / 2 + spaceBetween;
                if (prevSlideSize === 0 && i !== 0) slidePosition = slidePosition - swiperSize / 2 - spaceBetween;
                if (i === 0) slidePosition = slidePosition - swiperSize / 2 - spaceBetween;
                if (Math.abs(slidePosition) < 1 / 1e3) slidePosition = 0;
                if (params.roundLengths) slidePosition = Math.floor(slidePosition);
                if (index % params.slidesPerGroup === 0) snapGrid.push(slidePosition);
                slidesGrid.push(slidePosition);
            } else {
                if (params.roundLengths) slidePosition = Math.floor(slidePosition);
                if ((index - Math.min(swiper.params.slidesPerGroupSkip, index)) % swiper.params.slidesPerGroup === 0) snapGrid.push(slidePosition);
                slidesGrid.push(slidePosition);
                slidePosition = slidePosition + slideSize + spaceBetween;
            }
            swiper.virtualSize += slideSize + spaceBetween;
            prevSlideSize = slideSize;
            index += 1;
        }
        swiper.virtualSize = Math.max(swiper.virtualSize, swiperSize) + offsetAfter;
        if (rtl && wrongRTL && (params.effect === "slide" || params.effect === "coverflow")) wrapperEl.style.width = `${swiper.virtualSize + spaceBetween}px`;
        if (params.setWrapperSize) wrapperEl.style[swiper.getDirectionLabel("width")] = `${swiper.virtualSize + spaceBetween}px`;
        if (gridEnabled) swiper.grid.updateWrapperSize(slideSize, snapGrid);
        if (!params.centeredSlides) {
            const isFractionalSlidesPerView = params.slidesPerView !== "auto" && params.slidesPerView % 1 !== 0;
            const shouldSnapToSlideEdge = params.snapToSlideEdge && !params.loop && (params.slidesPerView === "auto" || isFractionalSlidesPerView);
            let lastAllowedSnapIndex = snapGrid.length;
            if (shouldSnapToSlideEdge) {
                let minVisibleSlides;
                if (params.slidesPerView === "auto") {
                    minVisibleSlides = 1;
                    let accumulatedSize = 0;
                    for (let i = slidesSizesGrid.length - 1; i >= 0; i -= 1) {
                        accumulatedSize += slidesSizesGrid[i] + (i < slidesSizesGrid.length - 1 ? spaceBetween : 0);
                        if (accumulatedSize <= swiperSize) minVisibleSlides = slidesSizesGrid.length - i; else break;
                    }
                } else minVisibleSlides = Math.floor(params.slidesPerView);
                lastAllowedSnapIndex = Math.max(slidesLength - minVisibleSlides, 0);
            }
            const newSlidesGrid = [];
            for (let i = 0; i < snapGrid.length; i += 1) {
                let slidesGridItem = snapGrid[i];
                if (params.roundLengths) slidesGridItem = Math.floor(slidesGridItem);
                if (shouldSnapToSlideEdge) {
                    if (i <= lastAllowedSnapIndex) newSlidesGrid.push(slidesGridItem);
                } else if (snapGrid[i] <= swiper.virtualSize - swiperSize) newSlidesGrid.push(slidesGridItem);
            }
            snapGrid = newSlidesGrid;
            if (Math.floor(swiper.virtualSize - swiperSize) - Math.floor(snapGrid[snapGrid.length - 1]) > 1) if (!shouldSnapToSlideEdge) snapGrid.push(swiper.virtualSize - swiperSize);
        }
        if (isVirtual && params.loop) {
            const size = slidesSizesGrid[0] + spaceBetween;
            const slidesBefore = swiper.virtual.slidesBefore ?? 0;
            const slidesAfter = swiper.virtual.slidesAfter ?? 0;
            const virtualLoopCount = slidesBefore + slidesAfter;
            if (params.slidesPerGroup > 1) {
                const groups = Math.ceil(virtualLoopCount / params.slidesPerGroup);
                const groupSize = size * params.slidesPerGroup;
                for (let i = 0; i < groups; i += 1) snapGrid.push(snapGrid[snapGrid.length - 1] + groupSize);
            }
            for (let i = 0; i < virtualLoopCount; i += 1) {
                if (params.slidesPerGroup === 1) snapGrid.push(snapGrid[snapGrid.length - 1] + size);
                slidesGrid.push(slidesGrid[slidesGrid.length - 1] + size);
                swiper.virtualSize += size;
            }
        }
        if (snapGrid.length === 0) snapGrid = [ 0 ];
        if (spaceBetween !== 0) {
            const key = swiper.isHorizontal() && rtl ? "marginLeft" : swiper.getDirectionLabel("marginRight");
            slides.filter((_, slideIndex) => {
                if (!params.cssMode || params.loop) return true;
                if (slideIndex === slides.length - 1) return false;
                return true;
            }).forEach(slideEl => {
                slideEl.style[key] = `${spaceBetween}px`;
            });
        }
        if (params.centeredSlides && params.centeredSlidesBounds) {
            let allSlidesSize = 0;
            slidesSizesGrid.forEach(slideSizeValue => {
                allSlidesSize += slideSizeValue + (spaceBetween || 0);
            });
            allSlidesSize -= spaceBetween;
            const maxSnap = allSlidesSize > swiperSize ? allSlidesSize - swiperSize : 0;
            snapGrid = snapGrid.map(snap => {
                if (snap <= 0) return -offsetBefore;
                if (snap > maxSnap) return maxSnap + offsetAfter;
                return snap;
            });
        }
        if (params.centerInsufficientSlides) {
            let allSlidesSize = 0;
            slidesSizesGrid.forEach(slideSizeValue => {
                allSlidesSize += slideSizeValue + (spaceBetween || 0);
            });
            allSlidesSize -= spaceBetween;
            if (allSlidesSize < swiperSize) {
                const allSlidesOffset = (swiperSize - allSlidesSize) / 2;
                snapGrid.forEach((snap, snapIndex) => {
                    snapGrid[snapIndex] = snap - allSlidesOffset;
                });
                slidesGrid.forEach((snap, snapIndex) => {
                    slidesGrid[snapIndex] = snap + allSlidesOffset;
                });
            }
        }
        Object.assign(swiper, {
            slides,
            snapGrid,
            slidesGrid,
            slidesSizesGrid
        });
        if (params.centeredSlides && params.cssMode && !params.centeredSlidesBounds) {
            setCSSProperty(wrapperEl, "--swiper-centered-offset-before", `${-snapGrid[0]}px`);
            setCSSProperty(wrapperEl, "--swiper-centered-offset-after", `${swiper.size / 2 - slidesSizesGrid[slidesSizesGrid.length - 1] / 2}px`);
            const addToSnapGrid = -swiper.snapGrid[0];
            const addToSlidesGrid = -swiper.slidesGrid[0];
            swiper.snapGrid = swiper.snapGrid.map(v => v + addToSnapGrid);
            swiper.slidesGrid = swiper.slidesGrid.map(v => v + addToSlidesGrid);
        }
        if (slidesLength !== previousSlidesLength) swiper.emit("slidesLengthChange");
        if (snapGrid.length !== previousSnapGridLength) {
            if (swiper.params.watchOverflow) swiper.checkOverflow();
            swiper.emit("snapGridLengthChange");
        }
        if (slidesGrid.length !== previousSlidesGridLength) swiper.emit("slidesGridLengthChange");
        if (params.watchSlidesProgress) swiper.updateSlidesOffset();
        swiper.emit("slidesUpdated");
        if (!isVirtual && !params.cssMode && (params.effect === "slide" || params.effect === "fade")) {
            const backFaceHiddenClass = `${params.containerModifierClass}backface-hidden`;
            const hasClassBackfaceClassAdded = swiper.el.classList.contains(backFaceHiddenClass);
            if (slidesLength <= params.maxBackfaceHiddenSlides) {
                if (!hasClassBackfaceClassAdded) swiper.el.classList.add(backFaceHiddenClass);
            } else if (hasClassBackfaceClassAdded) swiper.el.classList.remove(backFaceHiddenClass);
        }
    }
    const toggleSlideClasses$1 = (slideEl, condition, className) => {
        if (condition && !slideEl.classList.contains(className)) slideEl.classList.add(className); else if (!condition && slideEl.classList.contains(className)) slideEl.classList.remove(className);
    };
    function updateSlidesClasses() {
        const swiper = this;
        const {slides, params, slidesEl, activeIndex} = swiper;
        const isVirtual = !!(swiper.virtual && params.virtual?.enabled);
        const gridEnabled = swiper.grid && params.grid && params.grid.rows > 1;
        const getFilteredSlide = selector => elementChildren(slidesEl, `.${params.slideClass}${selector}, swiper-slide${selector}`)[0];
        let activeSlide;
        let prevSlide;
        let nextSlide;
        if (isVirtual) if (params.loop) {
            const virtualSlides = swiper.virtual.slides;
            let slideIndex = activeIndex - (swiper.virtual.slidesBefore ?? 0);
            if (slideIndex < 0) slideIndex = virtualSlides.length + slideIndex;
            if (slideIndex >= virtualSlides.length) slideIndex -= virtualSlides.length;
            activeSlide = getFilteredSlide(`[data-swiper-slide-index="${slideIndex}"]`);
        } else activeSlide = getFilteredSlide(`[data-swiper-slide-index="${activeIndex}"]`); else if (gridEnabled) {
            activeSlide = slides.find(slideEl => slideEl.column === activeIndex);
            nextSlide = slides.find(slideEl => slideEl.column === activeIndex + 1);
            prevSlide = slides.find(slideEl => slideEl.column === activeIndex - 1);
        } else activeSlide = slides[activeIndex];
        if (activeSlide) if (!gridEnabled) {
            nextSlide = elementNextAll(activeSlide, `.${params.slideClass}, swiper-slide`)[0];
            if (params.loop && !nextSlide) nextSlide = slides[0];
            prevSlide = elementPrevAll(activeSlide, `.${params.slideClass}, swiper-slide`)[0];
            if (params.loop && !prevSlide === 0) prevSlide = slides[slides.length - 1];
        }
        slides.forEach(slideEl => {
            toggleSlideClasses$1(slideEl, slideEl === activeSlide, params.slideActiveClass);
            toggleSlideClasses$1(slideEl, slideEl === nextSlide, params.slideNextClass);
            toggleSlideClasses$1(slideEl, slideEl === prevSlide, params.slidePrevClass);
        });
        swiper.emitSlidesClasses();
    }
    function updateSlidesOffset() {
        const swiper = this;
        const slides = swiper.slides;
        const minusOffset = swiper.isElement ? swiper.isHorizontal() ? swiper.wrapperEl.offsetLeft : swiper.wrapperEl.offsetTop : 0;
        for (let i = 0; i < slides.length; i += 1) slides[i].swiperSlideOffset = (swiper.isHorizontal() ? slides[i].offsetLeft : slides[i].offsetTop) - minusOffset - swiper.cssOverflowAdjustment();
    }
    const toggleSlideClasses = (slideEl, condition, className) => {
        if (condition && !slideEl.classList.contains(className)) slideEl.classList.add(className); else if (!condition && slideEl.classList.contains(className)) slideEl.classList.remove(className);
    };
    function updateSlidesProgress(translate = this && this.translate || 0) {
        const swiper = this;
        const params = swiper.params;
        const {slides, rtlTranslate: rtl, snapGrid} = swiper;
        if (slides.length === 0) return;
        if (typeof slides[0].swiperSlideOffset === "undefined") swiper.updateSlidesOffset();
        let offsetCenter = -translate;
        if (rtl) offsetCenter = translate;
        swiper.visibleSlidesIndexes = [];
        swiper.visibleSlides = [];
        let spaceBetween = params.spaceBetween;
        if (typeof spaceBetween === "string" && spaceBetween.indexOf("%") >= 0) spaceBetween = parseFloat(spaceBetween.replace("%", "")) / 100 * swiper.size; else if (typeof spaceBetween === "string") spaceBetween = parseFloat(spaceBetween);
        for (let i = 0; i < slides.length; i += 1) {
            const slide = slides[i];
            let slideOffset = slide.swiperSlideOffset ?? 0;
            if (params.cssMode && params.centeredSlides) slideOffset -= slides[0].swiperSlideOffset ?? 0;
            const slideSize = slide.swiperSlideSize ?? 0;
            const slideProgress = (offsetCenter + (params.centeredSlides ? swiper.minTranslate() : 0) - slideOffset) / (slideSize + spaceBetween);
            const originalSlideProgress = (offsetCenter - snapGrid[0] + (params.centeredSlides ? swiper.minTranslate() : 0) - slideOffset) / (slideSize + spaceBetween);
            const slideBefore = -(offsetCenter - slideOffset);
            const slideAfter = slideBefore + swiper.slidesSizesGrid[i];
            const isFullyVisible = slideBefore >= 0 && slideBefore <= swiper.size - swiper.slidesSizesGrid[i];
            const isVisible = slideBefore >= 0 && slideBefore < swiper.size - 1 || slideAfter > 1 && slideAfter <= swiper.size || slideBefore <= 0 && slideAfter >= swiper.size;
            if (isVisible) {
                swiper.visibleSlides.push(slide);
                swiper.visibleSlidesIndexes.push(i);
            }
            toggleSlideClasses(slide, isVisible, params.slideVisibleClass);
            toggleSlideClasses(slide, isFullyVisible, params.slideFullyVisibleClass);
            slide.progress = rtl ? -slideProgress : slideProgress;
            slide.originalProgress = rtl ? -originalSlideProgress : originalSlideProgress;
        }
    }
    var update = {
        updateSize,
        updateSlides,
        updateAutoHeight,
        updateSlidesOffset,
        updateSlidesProgress,
        updateProgress,
        updateSlidesClasses,
        updateActiveIndex,
        updateClickedSlide
    };
    const prototypes = {
        eventsEmitter,
        update,
        translate,
        transition,
        slide,
        loop,
        grabCursor,
        events: events$1,
        breakpoints,
        checkOverflow: checkOverflow$1,
        classes
    };
    const extendedDefaults = {};
    class Swiper {
        static extendedDefaults;
        static defaults;
        constructor(...args) {
            let el;
            let params;
            if (args.length === 1 && args[0] !== null && typeof args[0] === "object" && Object.prototype.toString.call(args[0]).slice(8, -1) === "Object") params = args[0]; else [el, params] = args;
            if (!params) params = {};
            params = extend({}, params);
            if (el && !params.el) params.el = el;
            if (params.el && typeof params.el === "string" && typeof document !== "undefined" && document.querySelectorAll(params.el).length > 1) {
                const swipers = [];
                document.querySelectorAll(params.el).forEach(containerEl => {
                    const newParams = extend({}, params, {
                        el: containerEl
                    });
                    swipers.push(new Swiper(newParams));
                });
                return swipers;
            }
            const swiper = this;
            swiper.__swiper__ = true;
            swiper.support = getSupport();
            swiper.device = getDevice({
                userAgent: params.userAgent ?? void 0
            });
            swiper.browser = getBrowser();
            swiper.eventsListeners = {};
            swiper.eventsAnyListeners = [];
            swiper.modules = [ ...swiper.__modules__ || [] ];
            if (params.modules && Array.isArray(params.modules)) params.modules.forEach(mod => {
                const fn = mod;
                if (typeof fn === "function" && swiper.modules.indexOf(fn) < 0) swiper.modules.push(fn);
            });
            const allModulesParams = {};
            swiper.modules.forEach(mod => {
                mod({
                    params,
                    swiper,
                    extendParams: moduleExtendParams(params, allModulesParams),
                    on: swiper.on.bind(swiper),
                    once: swiper.once.bind(swiper),
                    off: swiper.off.bind(swiper),
                    emit: swiper.emit.bind(swiper)
                });
            });
            const swiperParams = extend({}, defaults, allModulesParams);
            swiper.params = extend({}, swiperParams, extendedDefaults, params);
            swiper.originalParams = extend({}, swiper.params);
            swiper.passedParams = extend({}, params);
            if (swiper.params && swiper.params.on) {
                const onHandlers = swiper.params.on;
                Object.keys(onHandlers).forEach(eventName => {
                    const handler = onHandlers[eventName];
                    if (handler) swiper.on(eventName, handler);
                });
            }
            if (swiper.params && swiper.params.onAny) swiper.onAny(swiper.params.onAny);
            Object.assign(swiper, {
                enabled: swiper.params.enabled,
                el,
                classNames: [],
                slides: [],
                slidesGrid: [],
                snapGrid: [],
                slidesSizesGrid: [],
                isHorizontal() {
                    return swiper.params.direction === "horizontal";
                },
                isVertical() {
                    return swiper.params.direction === "vertical";
                },
                activeIndex: 0,
                realIndex: 0,
                isBeginning: true,
                isEnd: false,
                translate: 0,
                previousTranslate: 0,
                progress: 0,
                velocity: 0,
                animating: false,
                cssOverflowAdjustment() {
                    return Math.trunc(this.translate / 2 ** 23) * 2 ** 23;
                },
                allowSlideNext: swiper.params.allowSlideNext,
                allowSlidePrev: swiper.params.allowSlidePrev,
                touchEventsData: {
                    isTouched: void 0,
                    isMoved: void 0,
                    allowTouchCallbacks: void 0,
                    touchStartTime: void 0,
                    isScrolling: void 0,
                    currentTranslate: void 0,
                    startTranslate: void 0,
                    allowThresholdMove: void 0,
                    focusableElements: swiper.params.focusableElements,
                    lastClickTime: 0,
                    clickTimeout: void 0,
                    velocities: [],
                    allowMomentumBounce: void 0,
                    startMoving: void 0,
                    pointerId: null,
                    touchId: null
                },
                allowClick: true,
                allowTouchMove: swiper.params.allowTouchMove,
                touches: {
                    startX: 0,
                    startY: 0,
                    currentX: 0,
                    currentY: 0,
                    diff: 0
                },
                imagesToLoad: [],
                imagesLoaded: 0
            });
            swiper.emit("_swiper");
            if (swiper.params.init) swiper.init();
            return swiper;
        }
        getDirectionLabel(property) {
            if (this.isHorizontal()) return property;
            return {
                width: "height",
                "margin-top": "margin-left",
                "margin-bottom ": "margin-right",
                "margin-left": "margin-top",
                "margin-right": "margin-bottom",
                "padding-left": "padding-top",
                "padding-right": "padding-bottom",
                marginRight: "marginBottom"
            }[property];
        }
        isHorizontal() {
            return this.params.direction === "horizontal";
        }
        isVertical() {
            return this.params.direction === "vertical";
        }
        cssOverflowAdjustment() {
            return Math.trunc(this.translate / 2 ** 23) * 2 ** 23;
        }
        getSlideIndex(slideEl) {
            const {slidesEl, params} = this;
            const slides = elementChildren(slidesEl, `.${params.slideClass}, swiper-slide`);
            const firstSlideIndex = elementIndex(slides[0]);
            return elementIndex(slideEl) - (firstSlideIndex ?? 0);
        }
        getSlideIndexByData(index) {
            return this.getSlideIndex(this.slides.find(slideEl => Number(slideEl.getAttribute("data-swiper-slide-index")) === index));
        }
        getSlideIndexWhenGrid(index) {
            if (this.grid && this.params.grid && this.params.grid.rows > 1) if (this.params.grid.fill === "column") index = Math.floor(index / this.params.grid.rows); else if (this.params.grid.fill === "row") index %= Math.ceil(this.slides.length / this.params.grid.rows);
            return index;
        }
        recalcSlides() {
            const {slidesEl, params} = this;
            this.slides = elementChildren(slidesEl, `.${params.slideClass}, swiper-slide`);
        }
        enable() {
            if (this.enabled) return;
            this.enabled = true;
            if (this.params.grabCursor) this.setGrabCursor();
            this.emit("enable");
        }
        disable() {
            if (!this.enabled) return;
            this.enabled = false;
            if (this.params.grabCursor) this.unsetGrabCursor();
            this.emit("disable");
        }
        setProgress(progress, speed) {
            progress = Math.min(Math.max(progress, 0), 1);
            const min = this.minTranslate();
            const max = this.maxTranslate();
            const current = (max - min) * progress + min;
            this.translateTo(current, typeof speed === "undefined" ? 0 : speed);
            this.updateActiveIndex();
            this.updateSlidesClasses();
        }
        emitContainerClasses() {
            if (!this.params._emitClasses || !this.el) return;
            const cls = this.el.className.split(" ").filter(className => className.indexOf("swiper") === 0 || className.indexOf(this.params.containerModifierClass) === 0);
            this.emit("_containerClasses", cls.join(" "));
        }
        getSlideClasses(slideEl) {
            if (this.destroyed) return "";
            return slideEl.className.split(" ").filter(className => className.indexOf("swiper-slide") === 0 || className.indexOf(this.params.slideClass) === 0).join(" ");
        }
        emitSlidesClasses() {
            if (!this.params._emitClasses || !this.el) return;
            const updates = [];
            this.slides.forEach(slideEl => {
                const classNames = this.getSlideClasses(slideEl);
                updates.push({
                    slideEl,
                    classNames
                });
                this.emit("_slideClass", slideEl, classNames);
            });
            this.emit("_slideClasses", updates);
        }
        slidesPerViewDynamic(view = "current", exact = false) {
            const {params, slides, slidesGrid, slidesSizesGrid, size: swiperSize, activeIndex} = this;
            let spv = 1;
            if (typeof params.slidesPerView === "number") return params.slidesPerView;
            if (!swiperSize) return spv;
            if (params.centeredSlides) {
                let slideSize = slides[activeIndex] ? Math.ceil(slides[activeIndex].swiperSlideSize ?? 0) : 0;
                let breakLoop = false;
                for (let i = activeIndex + 1; i < slides.length; i += 1) if (slides[i] && !breakLoop) {
                    slideSize += Math.ceil(slides[i].swiperSlideSize ?? 0);
                    spv += 1;
                    if (slideSize > swiperSize) breakLoop = true;
                }
                for (let i = activeIndex - 1; i >= 0; i -= 1) if (slides[i] && !breakLoop) {
                    slideSize += slides[i].swiperSlideSize ?? 0;
                    spv += 1;
                    if (slideSize > swiperSize) breakLoop = true;
                }
            } else if (view === "current") for (let i = activeIndex + 1; i < slides.length; i += 1) {
                const slideInView = exact ? slidesGrid[i] + slidesSizesGrid[i] - slidesGrid[activeIndex] < swiperSize : slidesGrid[i] - slidesGrid[activeIndex] < swiperSize;
                if (slideInView) spv += 1;
            } else for (let i = activeIndex - 1; i >= 0; i -= 1) {
                const slideInView = slidesGrid[activeIndex] - slidesGrid[i] < swiperSize;
                if (slideInView) spv += 1;
            }
            return spv;
        }
        update() {
            const swiper = this;
            if (!swiper || swiper.destroyed) return;
            const {snapGrid, params} = swiper;
            if (params.breakpoints) swiper.setBreakpoint();
            [ ...swiper.el.querySelectorAll('[loading="lazy"]') ].forEach(imageEl => {
                if (imageEl.complete) processLazyPreloader(swiper, imageEl);
            });
            swiper.updateSize();
            swiper.updateSlides();
            swiper.updateProgress();
            swiper.updateSlidesClasses();
            function setTranslate() {
                const translateValue = swiper.rtlTranslate ? swiper.translate * -1 : swiper.translate;
                const newTranslate = Math.min(Math.max(translateValue, swiper.maxTranslate()), swiper.minTranslate());
                swiper.setTranslate(newTranslate);
                swiper.updateActiveIndex();
                swiper.updateSlidesClasses();
            }
            let translated;
            if (params.freeMode?.enabled && !params.cssMode) {
                setTranslate();
                if (params.autoHeight) swiper.updateAutoHeight();
            } else {
                if ((params.slidesPerView === "auto" || params.slidesPerView > 1) && swiper.isEnd && !params.centeredSlides) {
                    const slidesLength = swiper.virtual && params.virtual?.enabled ? swiper.virtual.slides.length : swiper.slides.length;
                    translated = swiper.slideTo(slidesLength - 1, 0, false, true);
                } else translated = swiper.slideTo(swiper.activeIndex, 0, false, true);
                if (!translated) setTranslate();
            }
            if (params.watchOverflow && snapGrid !== swiper.snapGrid) swiper.checkOverflow();
            swiper.emit("update");
        }
        changeDirection(newDirection, needUpdate = true) {
            const swiper = this;
            const currentDirection = swiper.params.direction;
            if (!newDirection) newDirection = currentDirection === "horizontal" ? "vertical" : "horizontal";
            if (newDirection === currentDirection || newDirection !== "horizontal" && newDirection !== "vertical") return swiper;
            swiper.el.classList.remove(`${swiper.params.containerModifierClass}${currentDirection}`);
            swiper.el.classList.add(`${swiper.params.containerModifierClass}${newDirection}`);
            swiper.emitContainerClasses();
            swiper.params.direction = newDirection;
            swiper.slides.forEach(slideEl => {
                if (newDirection === "vertical") slideEl.style.width = ""; else slideEl.style.height = "";
            });
            swiper.emit("changeDirection");
            if (needUpdate) swiper.update();
            return swiper;
        }
        changeLanguageDirection(direction) {
            const swiper = this;
            if (swiper.rtl && direction === "rtl" || !swiper.rtl && direction === "ltr") return;
            swiper.rtl = direction === "rtl";
            swiper.rtlTranslate = swiper.params.direction === "horizontal" && swiper.rtl;
            if (swiper.rtl) {
                swiper.el.classList.add(`${swiper.params.containerModifierClass}rtl`);
                swiper.el.dir = "rtl";
            } else {
                swiper.el.classList.remove(`${swiper.params.containerModifierClass}rtl`);
                swiper.el.dir = "ltr";
            }
            swiper.update();
        }
        mount(element) {
            const swiper = this;
            if (swiper.mounted) return true;
            if (typeof document === "undefined") return false;
            const initialEl = element ?? swiper.params.el;
            let el = null;
            if (typeof initialEl === "string") el = document.querySelector(initialEl); else if (initialEl instanceof HTMLElement) el = initialEl;
            if (!el) return false;
            el.swiper = swiper;
            const parent = el.parentNode;
            if (parent && parent.host && parent.host.nodeName === swiper.params.swiperElementNodeName.toUpperCase()) swiper.isElement = true;
            const getWrapperSelector = () => `.${(swiper.params.wrapperClass || "").trim().split(" ").join(".")}`;
            const getWrapper = () => {
                if (el && el.shadowRoot) {
                    const res = el.shadowRoot.querySelector(getWrapperSelector());
                    return res;
                }
                return elementChildren(el, getWrapperSelector())[0];
            };
            let wrapperEl = getWrapper();
            if (!wrapperEl && swiper.params.createElements) {
                wrapperEl = createElement("div", swiper.params.wrapperClass);
                el.append(wrapperEl);
                elementChildren(el, `.${swiper.params.slideClass}`).forEach(slideEl => {
                    wrapperEl.append(slideEl);
                });
            }
            const host = swiper.isElement ? el.parentNode.host : null;
            Object.assign(swiper, {
                el,
                wrapperEl,
                slidesEl: swiper.isElement && !host.slideSlots ? host : wrapperEl,
                hostEl: swiper.isElement ? host : el,
                mounted: true,
                rtl: el.dir.toLowerCase() === "rtl" || elementStyle(el, "direction") === "rtl",
                rtlTranslate: swiper.params.direction === "horizontal" && (el.dir.toLowerCase() === "rtl" || elementStyle(el, "direction") === "rtl"),
                wrongRTL: elementStyle(wrapperEl, "display") === "-webkit-box"
            });
            return true;
        }
        init(el) {
            const swiper = this;
            if (swiper.initialized) return swiper;
            const mounted = swiper.mount(el);
            if (mounted === false) return swiper;
            swiper.emit("beforeInit");
            if (swiper.params.breakpoints) swiper.setBreakpoint();
            swiper.addClasses();
            swiper.updateSize();
            swiper.updateSlides();
            if (swiper.params.watchOverflow) swiper.checkOverflow();
            if (swiper.params.grabCursor && swiper.enabled) swiper.setGrabCursor();
            if (swiper.params.loop && swiper.virtual && swiper.params.virtual?.enabled) swiper.slideTo((swiper.params.initialSlide ?? 0) + (swiper.virtual.slidesBefore ?? 0), 0, swiper.params.runCallbacksOnInit, false, true); else swiper.slideTo(swiper.params.initialSlide, 0, swiper.params.runCallbacksOnInit, false, true);
            if (swiper.params.loop) swiper.loopCreate(void 0, true);
            swiper.attachEvents();
            const lazyElements = [ ...swiper.el.querySelectorAll('[loading="lazy"]') ];
            if (swiper.isElement) lazyElements.push(...swiper.hostEl.querySelectorAll('[loading="lazy"]'));
            lazyElements.forEach(imageEl => {
                if (imageEl.complete) processLazyPreloader(swiper, imageEl); else imageEl.addEventListener("load", e => {
                    processLazyPreloader(swiper, e.target);
                });
            });
            preload(swiper);
            swiper.initialized = true;
            preload(swiper);
            swiper.emit("init");
            swiper.emit("afterInit");
            return swiper;
        }
        destroy(deleteInstance = true, cleanStyles = true) {
            const swiper = this;
            const {params, el, wrapperEl, slides} = swiper;
            if (typeof swiper.params === "undefined" || swiper.destroyed) return null;
            swiper.emit("beforeDestroy");
            swiper.initialized = false;
            swiper.detachEvents();
            if (params.loop) swiper.loopDestroy();
            if (cleanStyles) {
                swiper.removeClasses();
                if (el && typeof el !== "string") el.removeAttribute("style");
                if (wrapperEl) wrapperEl.removeAttribute("style");
                if (slides && slides.length) slides.forEach(slideEl => {
                    slideEl.classList.remove(params.slideVisibleClass, params.slideFullyVisibleClass, params.slideActiveClass, params.slideNextClass, params.slidePrevClass);
                    slideEl.removeAttribute("style");
                    slideEl.removeAttribute("data-swiper-slide-index");
                });
            }
            swiper.emit("destroy");
            Object.keys(swiper.eventsListeners).forEach(eventName => {
                swiper.off(eventName);
            });
            if (deleteInstance !== false) {
                if (swiper.el && typeof swiper.el !== "string") swiper.el.swiper = null;
                deleteProps(swiper);
            }
            swiper.destroyed = true;
            return null;
        }
        static extendDefaults(newDefaults) {
            extend(extendedDefaults, newDefaults);
        }
        static installModule(mod) {
            if (!Swiper.prototype.__modules__) Swiper.prototype.__modules__ = [];
            const modules = Swiper.prototype.__modules__;
            if (typeof mod === "function" && modules.indexOf(mod) < 0) modules.push(mod);
        }
        static use(module) {
            if (Array.isArray(module)) {
                module.forEach(m => Swiper.installModule(m));
                return Swiper;
            }
            Swiper.installModule(module);
            return Swiper;
        }
    }
    Object.defineProperty(Swiper, "extendedDefaults", {
        get() {
            return extendedDefaults;
        }
    });
    Object.defineProperty(Swiper, "defaults", {
        get() {
            return defaults;
        }
    });
    const prototypeRecord = prototypes;
    const swiperProto = Swiper.prototype;
    Object.keys(prototypeRecord).forEach(prototypeGroup => {
        const group = prototypeRecord[prototypeGroup];
        Object.keys(group).forEach(protoMethod => {
            swiperProto[protoMethod] = group[protoMethod];
        });
    });
    Swiper.use([ Resize, Observer ]);
    function classesToSelector(classes = "") {
        return `.${classes.trim().replace(/([.:!+/()[\]#>~*^$|=,'"@{}\\])/g, "\\$1").replace(/ /g, ".")}`;
    }
    function createElementIfNotDefined(swiper, originalParams, params, checkProps) {
        const target = params ?? {};
        const original = originalParams ?? {};
        if (swiper.params.createElements) Object.keys(checkProps).forEach(key => {
            if (!target[key] && target.auto === true) {
                let element = elementChildren(swiper.el, `.${checkProps[key]}`)[0];
                if (!element) {
                    element = createElement("div", checkProps[key]);
                    element.className = checkProps[key];
                    swiper.el.append(element);
                }
                target[key] = element;
                original[key] = element;
            }
        });
        return target;
    }
    const isVirtualEnabled = swiper => !!swiper.virtual && !!swiper.params.virtual?.enabled;
    const isFreeModeEnabled = swiper => !!swiper.params.freeMode?.enabled;
    const getSlidesLength = swiper => {
        if (isVirtualEnabled(swiper)) return swiper.virtual.slides.length;
        const gridRows = swiper.params.grid?.rows;
        if (swiper.grid && gridRows && gridRows > 1) return swiper.slides.length / Math.ceil(gridRows);
        return swiper.slides.length;
    };
    const Pagination = ({swiper, extendParams, on, emit}) => {
        const pfx = "swiper-pagination";
        extendParams({
            pagination: {
                el: null,
                bulletElement: "span",
                clickable: false,
                hideOnClick: false,
                renderBullet: null,
                renderProgressbar: null,
                renderFraction: null,
                renderCustom: null,
                progressbarOpposite: false,
                type: "bullets",
                dynamicBullets: false,
                dynamicMainBullets: 1,
                formatFractionCurrent: number => number,
                formatFractionTotal: number => number,
                bulletClass: `${pfx}-bullet`,
                bulletActiveClass: `${pfx}-bullet-active`,
                modifierClass: `${pfx}-`,
                currentClass: `${pfx}-current`,
                totalClass: `${pfx}-total`,
                hiddenClass: `${pfx}-hidden`,
                progressbarFillClass: `${pfx}-progressbar-fill`,
                progressbarOppositeClass: `${pfx}-progressbar-opposite`,
                clickableClass: `${pfx}-clickable`,
                lockClass: `${pfx}-lock`,
                horizontalClass: `${pfx}-horizontal`,
                verticalClass: `${pfx}-vertical`,
                paginationDisabledClass: `${pfx}-disabled`
            }
        });
        swiper.pagination = {
            el: null,
            bullets: []
        };
        let bulletSize;
        let dynamicBulletIndex = 0;
        function getParams() {
            return swiper.params.pagination;
        }
        function isPaginationDisabled() {
            const elParam = getParams().el;
            return !elParam || !swiper.pagination.el || Array.isArray(swiper.pagination.el) && swiper.pagination.el.length === 0;
        }
        function setSideBullets(bulletEl, position) {
            const {bulletActiveClass} = getParams();
            if (!bulletEl) return;
            let current = bulletEl[`${position === "prev" ? "previous" : "next"}ElementSibling`];
            if (current) {
                current.classList.add(`${bulletActiveClass}-${position}`);
                current = current[`${position === "prev" ? "previous" : "next"}ElementSibling`];
                if (current) current.classList.add(`${bulletActiveClass}-${position}-${position}`);
            }
        }
        function getMoveDirection(prevIndex, nextIndex, length) {
            prevIndex %= length;
            nextIndex %= length;
            if (nextIndex === prevIndex + 1) return "next"; else if (nextIndex === prevIndex - 1) return "previous";
            return;
        }
        function onBulletClick(e) {
            const targetEl = e.target;
            const bulletEl = targetEl.closest(classesToSelector(getParams().bulletClass));
            if (!bulletEl) return;
            e.preventDefault();
            const index = (elementIndex(bulletEl) ?? 0) * (swiper.params.slidesPerGroup ?? 1);
            if (swiper.params.loop) {
                if (swiper.realIndex === index) return;
                const moveDirection = getMoveDirection(swiper.realIndex, index, swiper.slides.length);
                if (moveDirection === "next") swiper.slideNext(); else if (moveDirection === "previous") swiper.slidePrev(); else swiper.slideToLoop(index);
            } else swiper.slideTo(index);
        }
        function update() {
            const rtl = swiper.rtl;
            const params = getParams();
            if (isPaginationDisabled()) return;
            const els = makeElementsArray(swiper.pagination.el);
            let current;
            let previousIndex;
            const slidesLength = getSlidesLength(swiper);
            const total = swiper.params.loop ? Math.ceil(slidesLength / (swiper.params.slidesPerGroup ?? 1)) : swiper.snapGrid.length;
            if (swiper.params.loop) {
                previousIndex = swiper.previousRealIndex || 0;
                current = (swiper.params.slidesPerGroup ?? 1) > 1 ? Math.floor(swiper.realIndex / (swiper.params.slidesPerGroup ?? 1)) : swiper.realIndex;
            } else if (typeof swiper.snapIndex !== "undefined") {
                current = swiper.snapIndex;
                previousIndex = swiper.previousSnapIndex;
            } else {
                previousIndex = swiper.previousIndex || 0;
                current = swiper.activeIndex || 0;
            }
            if (params.type === "bullets" && swiper.pagination.bullets && swiper.pagination.bullets.length > 0) {
                const bullets = swiper.pagination.bullets;
                let firstIndex = 0;
                let lastIndex = 0;
                let midIndex = 0;
                if (params.dynamicBullets) {
                    bulletSize = elementOuterSize(bullets[0], swiper.isHorizontal() ? "width" : "height");
                    const dim = swiper.isHorizontal() ? "width" : "height";
                    els.forEach(subEl => {
                        subEl.style[dim] = `${(bulletSize ?? 0) * (params.dynamicMainBullets + 4)}px`;
                    });
                    if (params.dynamicMainBullets > 1 && previousIndex !== void 0) {
                        dynamicBulletIndex += current - (previousIndex || 0);
                        if (dynamicBulletIndex > params.dynamicMainBullets - 1) dynamicBulletIndex = params.dynamicMainBullets - 1; else if (dynamicBulletIndex < 0) dynamicBulletIndex = 0;
                    }
                    firstIndex = Math.max(current - dynamicBulletIndex, 0);
                    lastIndex = firstIndex + (Math.min(bullets.length, params.dynamicMainBullets) - 1);
                    midIndex = (lastIndex + firstIndex) / 2;
                }
                bullets.forEach(bulletEl => {
                    const classesToRemove = [ "", "-next", "-next-next", "-prev", "-prev-prev", "-main" ].map(suffix => `${params.bulletActiveClass}${suffix}`).flatMap(s => typeof s === "string" && s.includes(" ") ? s.split(" ") : [ s ]);
                    bulletEl.classList.remove(...classesToRemove);
                });
                if (els.length > 1) bullets.forEach(bullet => {
                    const bulletIndex = elementIndex(bullet);
                    if (bulletIndex === current) bullet.classList.add(...params.bulletActiveClass.split(" ")); else if (swiper.isElement) bullet.setAttribute("part", "bullet");
                    if (params.dynamicBullets && bulletIndex !== void 0) {
                        if (bulletIndex >= firstIndex && bulletIndex <= lastIndex) bullet.classList.add(...`${params.bulletActiveClass}-main`.split(" "));
                        if (bulletIndex === firstIndex) setSideBullets(bullet, "prev");
                        if (bulletIndex === lastIndex) setSideBullets(bullet, "next");
                    }
                }); else {
                    const bullet = bullets[current];
                    if (bullet) bullet.classList.add(...params.bulletActiveClass.split(" "));
                    if (swiper.isElement) bullets.forEach((bulletEl, bulletIndex) => {
                        bulletEl.setAttribute("part", bulletIndex === current ? "bullet-active" : "bullet");
                    });
                    if (params.dynamicBullets) {
                        const firstDisplayedBullet = bullets[firstIndex];
                        const lastDisplayedBullet = bullets[lastIndex];
                        for (let i = firstIndex; i <= lastIndex; i += 1) if (bullets[i]) bullets[i].classList.add(...`${params.bulletActiveClass}-main`.split(" "));
                        setSideBullets(firstDisplayedBullet, "prev");
                        setSideBullets(lastDisplayedBullet, "next");
                    }
                }
                if (params.dynamicBullets) {
                    const dynamicBulletsLength = Math.min(bullets.length, params.dynamicMainBullets + 4);
                    const bulletsOffset = ((bulletSize ?? 0) * dynamicBulletsLength - (bulletSize ?? 0)) / 2 - midIndex * (bulletSize ?? 0);
                    const offsetProp = rtl ? "right" : "left";
                    const positionDim = swiper.isHorizontal() ? offsetProp : "top";
                    bullets.forEach(bullet => {
                        bullet.style[positionDim] = `${bulletsOffset}px`;
                    });
                }
            }
            els.forEach((subEl, subElIndex) => {
                if (params.type === "fraction") {
                    subEl.querySelectorAll(classesToSelector(params.currentClass)).forEach(fractionEl => {
                        fractionEl.textContent = String(params.formatFractionCurrent(current + 1));
                    });
                    subEl.querySelectorAll(classesToSelector(params.totalClass)).forEach(totalEl => {
                        totalEl.textContent = String(params.formatFractionTotal(total));
                    });
                }
                if (params.type === "progressbar") {
                    let progressbarDirection;
                    if (params.progressbarOpposite) progressbarDirection = swiper.isHorizontal() ? "vertical" : "horizontal"; else progressbarDirection = swiper.isHorizontal() ? "horizontal" : "vertical";
                    const scale = (current + 1) / total;
                    let scaleX = 1;
                    let scaleY = 1;
                    if (progressbarDirection === "horizontal") scaleX = scale; else scaleY = scale;
                    subEl.querySelectorAll(classesToSelector(params.progressbarFillClass)).forEach(progressEl => {
                        progressEl.style.transform = `translate3d(0,0,0) scaleX(${scaleX}) scaleY(${scaleY})`;
                        progressEl.style.transitionDuration = `${swiper.params.speed}ms`;
                    });
                }
                if (params.type === "custom" && params.renderCustom) {
                    setInnerHTML(subEl, params.renderCustom(swiper, current + 1, total));
                    if (subElIndex === 0) emit("paginationRender", subEl);
                } else {
                    if (subElIndex === 0) emit("paginationRender", subEl);
                    emit("paginationUpdate", subEl);
                }
                if (swiper.params.watchOverflow && swiper.enabled) subEl.classList[swiper.isLocked ? "add" : "remove"](params.lockClass);
            });
        }
        function render() {
            const params = getParams();
            if (isPaginationDisabled()) return;
            const slidesLength = getSlidesLength(swiper);
            const els = makeElementsArray(swiper.pagination.el);
            let paginationHTML = "";
            if (params.type === "bullets") {
                let numberOfBullets = swiper.params.loop ? Math.ceil(slidesLength / (swiper.params.slidesPerGroup ?? 1)) : swiper.snapGrid.length;
                if (swiper.params.freeMode && isFreeModeEnabled(swiper) && numberOfBullets > slidesLength) numberOfBullets = slidesLength;
                for (let i = 0; i < numberOfBullets; i += 1) if (params.renderBullet) paginationHTML += params.renderBullet.call(swiper, i, params.bulletClass); else paginationHTML += `<${params.bulletElement} ${swiper.isElement ? 'part="bullet"' : ""} class="${params.bulletClass}"></${params.bulletElement}>`;
            }
            if (params.type === "fraction") if (params.renderFraction) paginationHTML = params.renderFraction.call(swiper, params.currentClass, params.totalClass); else paginationHTML = `<span class="${params.currentClass}"></span>` + " / " + `<span class="${params.totalClass}"></span>`;
            if (params.type === "progressbar") if (params.renderProgressbar) paginationHTML = params.renderProgressbar.call(swiper, params.progressbarFillClass); else paginationHTML = `<span class="${params.progressbarFillClass}"></span>`;
            swiper.pagination.bullets = [];
            els.forEach(subEl => {
                if (params.type !== "custom") setInnerHTML(subEl, paginationHTML || "");
                if (params.type === "bullets") swiper.pagination.bullets.push(...Array.from(subEl.querySelectorAll(classesToSelector(params.bulletClass))));
            });
            if (params.type !== "custom") emit("paginationRender", els[0]);
        }
        function init() {
            swiper.params.pagination = createElementIfNotDefined(swiper, swiper.originalParams.pagination, swiper.params.pagination, {
                el: "swiper-pagination"
            });
            const params = getParams();
            if (!params.el) return;
            let el;
            if (typeof params.el === "string" && swiper.isElement) el = swiper.el.querySelector(params.el);
            if (!el && typeof params.el === "string") el = [ ...document.querySelectorAll(params.el) ];
            if (!el) el = params.el;
            if (!el || Array.isArray(el) && el.length === 0) return;
            if (swiper.params.uniqueNavElements && typeof params.el === "string" && Array.isArray(el) && el.length > 1) {
                el = [ ...swiper.el.querySelectorAll(params.el) ];
                if (el.length > 1) {
                    const found = el.find(subEl => {
                        if (elementParents(subEl, ".swiper")[0] !== swiper.el) return false;
                        return true;
                    });
                    if (found) el = found;
                }
            }
            if (Array.isArray(el) && el.length === 1) el = el[0];
            Object.assign(swiper.pagination, {
                el
            });
            const els = makeElementsArray(el);
            els.forEach(subEl => {
                if (params.type === "bullets" && params.clickable) subEl.classList.add(...(params.clickableClass || "").split(" "));
                subEl.classList.add(params.modifierClass + params.type);
                subEl.classList.add(swiper.isHorizontal() ? params.horizontalClass : params.verticalClass);
                if (params.type === "bullets" && params.dynamicBullets) {
                    subEl.classList.add(`${params.modifierClass}${params.type}-dynamic`);
                    dynamicBulletIndex = 0;
                    if (params.dynamicMainBullets < 1) params.dynamicMainBullets = 1;
                }
                if (params.type === "progressbar" && params.progressbarOpposite) subEl.classList.add(params.progressbarOppositeClass);
                if (params.clickable) subEl.addEventListener("click", onBulletClick);
                if (!swiper.enabled) subEl.classList.add(params.lockClass);
            });
        }
        function destroy() {
            const params = getParams();
            if (isPaginationDisabled()) return;
            const el = swiper.pagination.el;
            if (el) {
                const els = makeElementsArray(el);
                els.forEach(subEl => {
                    subEl.classList.remove(params.hiddenClass);
                    subEl.classList.remove(params.modifierClass + params.type);
                    subEl.classList.remove(swiper.isHorizontal() ? params.horizontalClass : params.verticalClass);
                    if (params.clickable) {
                        subEl.classList.remove(...(params.clickableClass || "").split(" "));
                        subEl.removeEventListener("click", onBulletClick);
                    }
                });
            }
            if (swiper.pagination.bullets) swiper.pagination.bullets.forEach(subEl => subEl.classList.remove(...params.bulletActiveClass.split(" ")));
        }
        on("changeDirection", () => {
            if (!swiper.pagination || !swiper.pagination.el) return;
            const params = getParams();
            const els = makeElementsArray(swiper.pagination.el);
            els.forEach(subEl => {
                subEl.classList.remove(params.horizontalClass, params.verticalClass);
                subEl.classList.add(swiper.isHorizontal() ? params.horizontalClass : params.verticalClass);
            });
        });
        on("init", () => {
            if (getParams().enabled === false) disable(); else {
                init();
                render();
                update();
            }
        });
        on("activeIndexChange", () => {
            if (typeof swiper.snapIndex === "undefined") update();
        });
        on("snapIndexChange", () => {
            update();
        });
        on("snapGridLengthChange", () => {
            render();
            update();
        });
        on("destroy", () => {
            destroy();
        });
        on("enable disable", () => {
            const {el} = swiper.pagination;
            if (el) {
                const params = getParams();
                const els = makeElementsArray(el);
                els.forEach(subEl => subEl.classList[swiper.enabled ? "remove" : "add"](params.lockClass));
            }
        });
        on("lock unlock", () => {
            update();
        });
        on("click", (_s, e) => {
            const targetEl = e.target;
            const els = makeElementsArray(swiper.pagination.el);
            const params = getParams();
            if (params.el && params.hideOnClick && els && els.length > 0 && !targetEl.classList.contains(params.bulletClass)) {
                if (swiper.navigation && (swiper.navigation.nextEl && targetEl === swiper.navigation.nextEl || swiper.navigation.prevEl && targetEl === swiper.navigation.prevEl)) return;
                const isHidden = els[0].classList.contains(params.hiddenClass);
                if (isHidden === true) emit("paginationShow"); else emit("paginationHide");
                els.forEach(subEl => subEl.classList.toggle(params.hiddenClass));
            }
        });
        const enable = () => {
            const params = getParams();
            swiper.el.classList.remove(params.paginationDisabledClass);
            const {el} = swiper.pagination;
            if (el) {
                const els = makeElementsArray(el);
                els.forEach(subEl => subEl.classList.remove(params.paginationDisabledClass));
            }
            init();
            render();
            update();
        };
        const disable = () => {
            const params = getParams();
            swiper.el.classList.add(params.paginationDisabledClass);
            const {el} = swiper.pagination;
            if (el) {
                const els = makeElementsArray(el);
                els.forEach(subEl => subEl.classList.add(params.paginationDisabledClass));
            }
            destroy();
        };
        Object.assign(swiper.pagination, {
            enable,
            disable,
            render,
            update,
            init,
            destroy
        });
    };
    const arrowSvg = `<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"/></svg>`;
    const Navigation = ({swiper, extendParams, on, emit}) => {
        extendParams({
            navigation: {
                nextEl: null,
                prevEl: null,
                addIcons: true,
                hideOnClick: false,
                disabledClass: "swiper-button-disabled",
                hiddenClass: "swiper-button-hidden",
                lockClass: "swiper-button-lock",
                navigationDisabledClass: "swiper-navigation-disabled"
            }
        });
        swiper.navigation = {
            nextEl: null,
            prevEl: null,
            arrowSvg
        };
        function getParams() {
            return swiper.params.navigation;
        }
        function getEl(el) {
            let res;
            if (el && typeof el === "string" && swiper.isElement) {
                res = swiper.el.querySelector(el) || swiper.hostEl.querySelector(el);
                if (res) return res;
            }
            if (el) {
                if (typeof el === "string") res = [ ...document.querySelectorAll(el) ];
                if (swiper.params.uniqueNavElements && typeof el === "string" && res && res.length > 1 && swiper.el.querySelectorAll(el).length === 1) res = swiper.el.querySelector(el); else if (res && res.length === 1) res = res[0];
            }
            if (el && !res) return el;
            return res;
        }
        function toggleEl(el, disabled) {
            const params = getParams();
            const els = makeElementsArray(el);
            els.forEach(subEl => {
                if (subEl) {
                    subEl.classList[disabled ? "add" : "remove"](...params.disabledClass.split(" "));
                    if (subEl.tagName === "BUTTON") subEl.disabled = disabled;
                    if (swiper.params.watchOverflow && swiper.enabled) subEl.classList[swiper.isLocked ? "add" : "remove"](params.lockClass);
                }
            });
        }
        function update() {
            const {nextEl, prevEl} = swiper.navigation;
            if (swiper.params.loop) {
                toggleEl(prevEl, false);
                toggleEl(nextEl, false);
                return;
            }
            toggleEl(prevEl, swiper.isBeginning && !swiper.params.rewind);
            toggleEl(nextEl, swiper.isEnd && !swiper.params.rewind);
        }
        function onPrevClick(e) {
            e.preventDefault();
            if (swiper.isBeginning && !swiper.params.loop && !swiper.params.rewind) return;
            swiper.slidePrev();
            emit("navigationPrev");
        }
        function onNextClick(e) {
            e.preventDefault();
            if (swiper.isEnd && !swiper.params.loop && !swiper.params.rewind) return;
            swiper.slideNext();
            emit("navigationNext");
        }
        function init() {
            swiper.params.navigation = createElementIfNotDefined(swiper, swiper.originalParams.navigation, swiper.params.navigation, {
                nextEl: "swiper-button-next",
                prevEl: "swiper-button-prev"
            });
            const params = getParams();
            if (!(params.nextEl || params.prevEl)) return;
            const nextEl = getEl(params.nextEl);
            const prevEl = getEl(params.prevEl);
            Object.assign(swiper.navigation, {
                nextEl,
                prevEl
            });
            const nextEls = makeElementsArray(nextEl);
            const prevEls = makeElementsArray(prevEl);
            const initButton = (el, dir) => {
                if (el) {
                    if (params.addIcons && el.matches(".swiper-button-next,.swiper-button-prev") && !el.querySelector("svg")) {
                        const tempEl = document.createElement("div");
                        setInnerHTML(tempEl, arrowSvg);
                        const svgEl = tempEl.querySelector("svg");
                        if (svgEl) el.appendChild(svgEl);
                        tempEl.remove();
                    }
                    el.addEventListener("click", dir === "next" ? onNextClick : onPrevClick);
                }
                if (!swiper.enabled && el) el.classList.add(...params.lockClass.split(" "));
            };
            nextEls.forEach(el => initButton(el, "next"));
            prevEls.forEach(el => initButton(el, "prev"));
        }
        function destroy() {
            const params = getParams();
            const {nextEl, prevEl} = swiper.navigation;
            const nextEls = makeElementsArray(nextEl);
            const prevEls = makeElementsArray(prevEl);
            const destroyButton = (el, dir) => {
                el.removeEventListener("click", dir === "next" ? onNextClick : onPrevClick);
                el.classList.remove(...params.disabledClass.split(" "));
            };
            nextEls.forEach(el => destroyButton(el, "next"));
            prevEls.forEach(el => destroyButton(el, "prev"));
        }
        on("init", () => {
            if (getParams().enabled === false) disable(); else {
                init();
                update();
            }
        });
        on("toEdge fromEdge lock unlock", () => {
            update();
        });
        on("destroy", () => {
            destroy();
        });
        on("enable disable", () => {
            const params = getParams();
            const {nextEl, prevEl} = swiper.navigation;
            const nextEls = makeElementsArray(nextEl);
            const prevEls = makeElementsArray(prevEl);
            if (swiper.enabled) {
                update();
                return;
            }
            [ ...nextEls, ...prevEls ].filter(el => !!el).forEach(el => el.classList.add(params.lockClass));
        });
        on("click", (_s, e) => {
            const params = getParams();
            const {nextEl, prevEl} = swiper.navigation;
            const nextEls = makeElementsArray(nextEl);
            const prevEls = makeElementsArray(prevEl);
            const targetEl = e.target;
            let targetIsButton = prevEls.includes(targetEl) || nextEls.includes(targetEl);
            if (swiper.isElement && !targetIsButton) {
                const path = e.composedPath ? e.composedPath() : [];
                if (path.length) targetIsButton = path.find(pathEl => nextEls.includes(pathEl) || prevEls.includes(pathEl));
            }
            if (params.hideOnClick && !targetIsButton) {
                if (swiper.pagination && swiper.params.pagination && swiper.params.pagination.clickable && (swiper.pagination.el === targetEl || swiper.pagination.el.contains(targetEl))) return;
                let isHidden;
                if (nextEls.length) isHidden = nextEls[0].classList.contains(params.hiddenClass); else if (prevEls.length) isHidden = prevEls[0].classList.contains(params.hiddenClass);
                if (isHidden === true) emit("navigationShow"); else emit("navigationHide");
                [ ...nextEls, ...prevEls ].filter(el => !!el).forEach(el => el.classList.toggle(params.hiddenClass));
            }
        });
        const enable = () => {
            const params = getParams();
            swiper.el.classList.remove(...params.navigationDisabledClass.split(" "));
            init();
            update();
        };
        const disable = () => {
            const params = getParams();
            swiper.el.classList.add(...params.navigationDisabledClass.split(" "));
            destroy();
        };
        Object.assign(swiper.navigation, {
            enable,
            disable,
            update,
            init,
            destroy
        });
    };
    const Thumb = ({swiper, extendParams, on}) => {
        extendParams({
            thumbs: {
                swiper: null,
                multipleActiveThumbs: true,
                autoScrollOffset: 0,
                slideThumbActiveClass: "swiper-slide-thumb-active",
                thumbsContainerClass: "swiper-thumbs"
            }
        });
        let initialized = false;
        let swiperCreated = false;
        swiper.thumbs = {
            swiper: null
        };
        function getParams() {
            return swiper.params.thumbs;
        }
        function isVirtualEnabled() {
            const thumbsSwiper = swiper.thumbs.swiper;
            if (!thumbsSwiper || thumbsSwiper.destroyed) return false;
            const virtual = thumbsSwiper.params.virtual;
            return !!virtual && !!virtual.enabled;
        }
        function onThumbClick() {
            const thumbsSwiper = swiper.thumbs.swiper;
            if (!thumbsSwiper || thumbsSwiper.destroyed) return;
            const clickedIndex = thumbsSwiper.clickedIndex;
            const clickedSlide = thumbsSwiper.clickedSlide;
            const thumbsParams = getParams();
            if (clickedSlide && clickedSlide.classList.contains(thumbsParams.slideThumbActiveClass)) return;
            if (typeof clickedIndex === "undefined" || clickedIndex === null) return;
            let slideToIndex;
            if (thumbsSwiper.params.loop) {
                const attr = thumbsSwiper.clickedSlide?.getAttribute("data-swiper-slide-index");
                slideToIndex = attr == null ? clickedIndex : parseInt(attr, 10);
            } else slideToIndex = clickedIndex;
            if (swiper.params.loop) swiper.slideToLoop(slideToIndex); else swiper.slideTo(slideToIndex);
        }
        function init() {
            const thumbsParams = getParams();
            if (initialized) return false;
            initialized = true;
            const SwiperClass = swiper.constructor;
            if (thumbsParams.swiper instanceof SwiperClass) {
                if (thumbsParams.swiper.destroyed) {
                    initialized = false;
                    return false;
                }
                const thumbsSwiper = thumbsParams.swiper;
                swiper.thumbs.swiper = thumbsSwiper;
                Object.assign(thumbsSwiper.originalParams, {
                    watchSlidesProgress: true,
                    slideToClickedSlide: false
                });
                Object.assign(thumbsSwiper.params, {
                    watchSlidesProgress: true,
                    slideToClickedSlide: false
                });
                thumbsSwiper.update();
            } else if (isObject(thumbsParams.swiper)) {
                const thumbsSwiperParams = Object.assign({}, thumbsParams.swiper);
                Object.assign(thumbsSwiperParams, {
                    watchSlidesProgress: true,
                    slideToClickedSlide: false
                });
                swiper.thumbs.swiper = new SwiperClass(thumbsSwiperParams);
                swiperCreated = true;
            }
            const thumbsSwiper = swiper.thumbs.swiper;
            if (!thumbsSwiper) return false;
            thumbsSwiper.el.classList.add(thumbsParams.thumbsContainerClass);
            thumbsSwiper.on("tap", onThumbClick);
            if (isVirtualEnabled()) thumbsSwiper.on("virtualUpdate", () => {
                update(false, {
                    autoScroll: false
                });
            });
            return true;
        }
        function update(initial, p) {
            const thumbsSwiper = swiper.thumbs.swiper;
            if (!thumbsSwiper || thumbsSwiper.destroyed) return;
            let thumbsToActivate = 1;
            const thumbsParams = getParams();
            const thumbActiveClass = thumbsParams.slideThumbActiveClass;
            const slidesPerView = swiper.params.slidesPerView;
            if (typeof slidesPerView === "number" && slidesPerView > 1 && !swiper.params.centeredSlides) thumbsToActivate = slidesPerView;
            if (!thumbsParams.multipleActiveThumbs) thumbsToActivate = 1;
            thumbsToActivate = Math.floor(thumbsToActivate);
            thumbsSwiper.slides.forEach(slideEl => slideEl.classList.remove(thumbActiveClass));
            if (thumbsSwiper.params.loop || isVirtualEnabled()) for (let i = 0; i < thumbsToActivate; i += 1) elementChildren(thumbsSwiper.slidesEl, `[data-swiper-slide-index="${swiper.realIndex + i}"]`).forEach(slideEl => {
                slideEl.classList.add(thumbActiveClass);
            }); else for (let i = 0; i < thumbsToActivate; i += 1) {
                const slide = thumbsSwiper.slides[swiper.realIndex + i];
                if (slide) slide.classList.add(thumbActiveClass);
            }
            if (p?.autoScroll ?? true) autoScroll(initial ? 0 : void 0);
        }
        function autoScroll(slideSpeed) {
            const thumbsSwiper = swiper.thumbs.swiper;
            if (!thumbsSwiper || thumbsSwiper.destroyed) return;
            const thumbsSlidesPerView = thumbsSwiper.params.slidesPerView;
            const slidesPerView = thumbsSlidesPerView === "auto" ? thumbsSwiper.slidesPerViewDynamic() : thumbsSlidesPerView ?? 1;
            const autoScrollOffset = getParams().autoScrollOffset;
            const useOffset = autoScrollOffset && !thumbsSwiper.params.loop;
            if (swiper.realIndex !== thumbsSwiper.realIndex || useOffset) {
                const currentThumbsIndex = thumbsSwiper.activeIndex;
                let newThumbsIndex;
                let direction;
                if (thumbsSwiper.params.loop) {
                    const newThumbsSlide = thumbsSwiper.slides.find(slideEl => slideEl.getAttribute("data-swiper-slide-index") === `${swiper.realIndex}`);
                    newThumbsIndex = newThumbsSlide ? thumbsSwiper.slides.indexOf(newThumbsSlide) : -1;
                    direction = swiper.activeIndex > swiper.previousIndex ? "next" : "prev";
                } else {
                    newThumbsIndex = swiper.realIndex;
                    direction = newThumbsIndex > swiper.previousIndex ? "next" : "prev";
                }
                if (useOffset) newThumbsIndex += direction === "next" ? autoScrollOffset : -1 * autoScrollOffset;
                if (thumbsSwiper.visibleSlidesIndexes && thumbsSwiper.visibleSlidesIndexes.indexOf(newThumbsIndex) < 0) {
                    if (thumbsSwiper.params.centeredSlides) if (newThumbsIndex > currentThumbsIndex) newThumbsIndex = newThumbsIndex - Math.floor(slidesPerView / 2) + 1; else newThumbsIndex = newThumbsIndex + Math.floor(slidesPerView / 2) - 1; else if (newThumbsIndex > currentThumbsIndex && thumbsSwiper.params.slidesPerGroup === 1) ;
                    thumbsSwiper.slideTo(newThumbsIndex, slideSpeed);
                }
            }
        }
        on("beforeInit", () => {
            const thumbs = swiper.params.thumbs;
            if (!thumbs || !thumbs.swiper) return;
            if (typeof thumbs.swiper === "string" || thumbs.swiper instanceof HTMLElement) {
                const getThumbsElementAndInit = () => {
                    const thumbsElement = typeof thumbs.swiper === "string" ? document.querySelector(thumbs.swiper) : thumbs.swiper;
                    if (thumbsElement && thumbsElement.swiper) {
                        thumbs.swiper = thumbsElement.swiper;
                        init();
                        update(true);
                    } else if (thumbsElement) {
                        const eventName = `${swiper.params.eventsPrefix}init`;
                        const onThumbsSwiper = e => {
                            const detail = e.detail;
                            thumbs.swiper = detail[0];
                            thumbsElement.removeEventListener(eventName, onThumbsSwiper);
                            init();
                            update(true);
                            thumbs.swiper.update();
                            swiper.update();
                        };
                        thumbsElement.addEventListener(eventName, onThumbsSwiper);
                    }
                    return thumbsElement;
                };
                const watchForThumbsToAppear = () => {
                    if (swiper.destroyed) return;
                    const thumbsElement = getThumbsElementAndInit();
                    if (!thumbsElement) requestAnimationFrame(watchForThumbsToAppear);
                };
                requestAnimationFrame(watchForThumbsToAppear);
            } else {
                init();
                update(true);
            }
        });
        on("slideChange update resize observerUpdate", () => {
            update();
        });
        on("setTransition", (_s, duration) => {
            const thumbsSwiper = swiper.thumbs.swiper;
            if (!thumbsSwiper || thumbsSwiper.destroyed) return;
            thumbsSwiper.setTransition(duration);
        });
        on("beforeDestroy", () => {
            const thumbsSwiper = swiper.thumbs.swiper;
            if (!thumbsSwiper || thumbsSwiper.destroyed) return;
            if (swiperCreated) thumbsSwiper.destroy();
        });
        Object.assign(swiper.thumbs, {
            init,
            update
        });
    };
    function initSliders() {
        if (document.querySelector(".preview-slider")) {
            let initCounter = 0;
            const swiper = new Swiper(".preview-slider", {
                modules: [ Pagination ],
                observer: true,
                observeParents: true,
                slidesPerView: 1,
                spaceBetween: 10,
                speed: 800,
                loop: true,
                autoplay: {
                    delay: 3e3,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                    stopOnLastSlide: false,
                    waitForTransition: true
                },
                pagination: {
                    el: ".preview-slider-pagination",
                    clickable: true
                },
                on: {
                    init: function() {
                        const slider = this;
                        if (slider.autoplay) slider.autoplay.start();
                        slider.el.addEventListener("mouseenter", () => {
                            if (slider.autoplay) slider.autoplay.stop();
                        });
                        slider.el.addEventListener("mouseleave", () => {
                            if (slider.autoplay) slider.autoplay.start();
                        });
                        const videoStates = new Map;
                        const videos = slider.el.querySelectorAll("video");
                        const startVideoWithUserInteraction = video => {
                            if (!video) return;
                            video.muted = true;
                            video.play().catch(() => {
                                const clickHandler = () => {
                                    video.muted = true;
                                    video.play().catch(() => {});
                                    document.removeEventListener("click", clickHandler);
                                    document.removeEventListener("touchstart", clickHandler);
                                };
                                document.addEventListener("click", clickHandler);
                                document.addEventListener("touchstart", clickHandler);
                            });
                        };
                        videos.forEach(video => {
                            const slide = video.closest(".swiper-slide");
                            const muteButton = slide ? slide.querySelector(".preview-slider-video-mute") : null;
                            let icon = null;
                            if (muteButton) icon = muteButton.querySelector("iconify-icon");
                            video.muted = true;
                            if (icon) icon.setAttribute("icon", "mdi:mute");
                            videoStates.set(video, {
                                currentTime: 0,
                                isPaused: true
                            });
                            setTimeout(() => {
                                startVideoWithUserInteraction(video);
                            }, 500);
                            video.addEventListener("loadedmetadata", () => {
                                startVideoWithUserInteraction(video);
                            }, {
                                once: true
                            });
                            video.addEventListener("canplay", () => {
                                startVideoWithUserInteraction(video);
                            }, {
                                once: true
                            });
                            if (muteButton) muteButton.addEventListener("click", function(e) {
                                e.stopPropagation();
                                video.muted = !video.muted;
                                if (icon) if (video.muted) icon.setAttribute("icon", "mdi:mute"); else icon.setAttribute("icon", "octicon:unmute-16");
                                if (video.paused) video.play().catch(() => {});
                            });
                            if (icon) video.addEventListener("volumechange", function() {
                                if (video.muted) icon.setAttribute("icon", "mdi:mute"); else icon.setAttribute("icon", "octicon:unmute-16");
                            });
                            video.addEventListener("pause", function() {
                                const state = videoStates.get(this);
                                if (state) {
                                    state.currentTime = this.currentTime;
                                    state.isPaused = true;
                                }
                                if (!this.ended && swiper.autoplay) swiper.autoplay.start();
                            });
                            video.addEventListener("play", function() {
                                const state = videoStates.get(this);
                                if (state) state.isPaused = false;
                                if (swiper.autoplay) swiper.autoplay.stop();
                            });
                            video.addEventListener("timeupdate", function() {
                                const state = videoStates.get(this);
                                if (state) state.currentTime = this.currentTime;
                            });
                            video.addEventListener("ended", () => {
                                if (swiper.autoplay) swiper.autoplay.stop();
                                swiper.slideNext();
                                setTimeout(() => {
                                    if (swiper.autoplay) swiper.autoplay.start();
                                }, 1e3);
                            });
                            video.addEventListener("waiting", () => {
                                if (swiper.autoplay) swiper.autoplay.stop();
                            });
                            video.addEventListener("canplay", () => {
                                if (video.paused && !video.ended && swiper.autoplay) swiper.autoplay.start();
                            });
                            video.addEventListener("loadedmetadata", () => {
                                if (video.paused && !video.ended && swiper.autoplay) swiper.autoplay.start();
                            });
                            video.addEventListener("seeking", () => {
                                if (swiper.autoplay) swiper.autoplay.stop();
                            });
                            video.addEventListener("seeked", () => {
                                if (!video.paused && !video.ended && swiper.autoplay) swiper.autoplay.stop(); else if (video.paused && !video.ended && swiper.autoplay) swiper.autoplay.start();
                            });
                            video.addEventListener("ratechange", () => {
                                if (!video.paused && !video.ended && swiper.autoplay) swiper.autoplay.stop();
                            });
                        });
                        slider.on("slideChange", function() {
                            initCounter++;
                            if (initCounter <= 5) return;
                            const allVideos = slider.el.querySelectorAll("video");
                            allVideos.forEach(video => {
                                if (!video.paused) {
                                    video.pause();
                                    const state = videoStates.get(video);
                                    if (state) {
                                        state.currentTime = video.currentTime;
                                        state.isPaused = true;
                                    }
                                }
                            });
                            if (slider.autoplay) slider.autoplay.stop();
                        });
                        slider.on("slideChangeTransitionEnd", function() {
                            const activeSlide = slider.slides[slider.activeIndex];
                            if (activeSlide) {
                                const activeVideo = activeSlide.querySelector("video");
                                if (activeVideo) {
                                    const state = videoStates.get(activeVideo);
                                    if (state) {
                                        if (activeVideo.currentTime !== state.currentTime) activeVideo.currentTime = state.currentTime;
                                        setTimeout(() => {
                                            startVideoWithUserInteraction(activeVideo);
                                        }, 300);
                                        state.isPaused = false;
                                    }
                                }
                            }
                            const currentSlide = slider.slides[slider.activeIndex];
                            const hasVideo = currentSlide ? currentSlide.querySelector("video") : false;
                            if (!hasVideo && slider.autoplay) slider.autoplay.start();
                        });
                    }
                }
            });
        }
        if (document.querySelector(".home__feed-news-slider")) new Swiper(".home__feed-news-slider", {
            modules: [ Navigation, Pagination ],
            observer: true,
            observeParents: true,
            slidesPerView: 1,
            spaceBetween: 20,
            speed: 800,
            loop: true,
            navigation: {
                prevEl: ".home__feed-news-slider-button-prev",
                nextEl: ".home__feed-news-slider-button-next"
            },
            pagination: {
                el: ".home__feed-news-slider-pagination",
                clickable: true
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 20
                }
            }
        });
        if (document.querySelector(".universities__slider")) new Swiper(".universities__slider", {
            modules: [ Navigation, Pagination ],
            observer: true,
            observeParents: true,
            slidesPerView: 1,
            spaceBetween: 60,
            speed: 800,
            loop: true,
            navigation: {
                prevEl: ".universities__slider-button-prev",
                nextEl: ".universities__slider-button-next"
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 60
                }
            },
            pagination: {
                el: ".universities__slider-pagination",
                clickable: true
            }
        });
        if (document.querySelector(".universities__branches-slider")) {
            let branchesSlider = null;
            function initBranchesSlider() {
                const width = window.innerWidth;
                const needSlider = width <= 950;
                if (needSlider) {
                    if (!branchesSlider) branchesSlider = new Swiper(".universities__branches-slider", {
                        modules: [ Navigation ],
                        observer: true,
                        observeParents: true,
                        observeSlideChildren: true,
                        speed: 800,
                        loop: false,
                        slidesPerView: 1,
                        spaceBetween: 16,
                        navigation: {
                            prevEl: ".universities__branches-slider-button-prev",
                            nextEl: ".universities__branches-slider-button-next"
                        },
                        breakpoints: {
                            0: {
                                slidesPerView: 1,
                                spaceBetween: 20
                            },
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 16
                            }
                        },
                        on: {
                            init(swiper) {
                                swiper.update();
                            }
                        }
                    });
                } else if (branchesSlider) {
                    branchesSlider.destroy(true, true);
                    branchesSlider = null;
                    const wrapper = document.querySelector(".universities__branches-slider .swiper-wrapper");
                    const slides = document.querySelectorAll(".universities__branches-slider .swiper-slide");
                    const action = document.querySelector(".universities__branches-slider-action");
                    if (wrapper) wrapper.removeAttribute("style");
                    slides.forEach(slide => {
                        slide.removeAttribute("style");
                        slide.classList.remove("swiper-slide-active", "swiper-slide-next", "swiper-slide-prev");
                    });
                    if (action) action.style.display = "";
                }
            }
            initBranchesSlider();
            let resizeTimer;
            window.addEventListener("resize", () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    initBranchesSlider();
                }, 200);
            });
        }
        if (document.querySelector(".news__slider")) new Swiper(".news__slider", {
            modules: [ Navigation, Pagination ],
            observer: true,
            observeParents: true,
            slidesPerView: 1,
            spaceBetween: 60,
            speed: 800,
            loop: true,
            navigation: {
                prevEl: ".news__slider-button-prev",
                nextEl: ".news__slider-button-next"
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 60
                }
            },
            pagination: {
                el: ".news__slider-pagination",
                clickable: true
            }
        });
        if (document.querySelector(".page__image-slider-main")) new Swiper(".page__image-slider-main", {
            modules: [ Navigation, Thumb ],
            observer: true,
            observeParents: true,
            slidesPerView: 1,
            spaceBetween: 20,
            speed: 800,
            navigation: {
                prevEl: ".page__image-slider-prev",
                nextEl: ".page__image-slider-next"
            },
            thumbs: {
                swiper: {
                    el: ".page__image-slider-thumbs",
                    slidesPerView: 6,
                    spaceBetween: 10,
                    breakpoints: {
                        768: {
                            slidesPerView: 6,
                            spaceBetween: 8
                        },
                        1024: {
                            slidesPerView: 9,
                            spaceBetween: 8
                        }
                    }
                }
            }
        });
        if (document.querySelector(".footer__slider")) new Swiper(".footer__slider", {
            modules: [ Navigation ],
            observer: true,
            observeParents: true,
            slidesPerView: 4,
            spaceBetween: 20,
            speed: 800,
            loop: true,
            navigation: {
                prevEl: ".footer__slider-button-prev",
                nextEl: ".footer__slider-button-next"
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                767: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                    slidesPerGroup: 1
                }
            }
        });
    }
    window.addEventListener("load", function(e) {
        initSliders();
    });
    class Popup {
        constructor(options) {
            let config = {
                logging: true,
                init: true,
                attributeOpenButton: "data-popup",
                attributeCloseButton: "data-close",
                fixElementSelector: "[data-lp]",
                youtubeAttribute: "data-popup-youtube",
                youtubePlaceAttribute: "data-popup-youtube-place",
                setAutoplayYoutube: true,
                classes: {
                    popup: "popup",
                    popupContent: "popup__content",
                    popupActive: "popup_show",
                    bodyActive: "popup-show"
                },
                focusCatch: true,
                closeEsc: true,
                bodyLock: true,
                hashSettings: {
                    location: true,
                    goHash: true
                },
                on: {
                    beforeOpen: function() {},
                    afterOpen: function() {},
                    beforeClose: function() {},
                    afterClose: function() {}
                }
            };
            this.youTubeCode;
            this.isOpen = false;
            this.targetOpen = {
                selector: false,
                element: false
            };
            this.previousOpen = {
                selector: false,
                element: false
            };
            this.lastClosed = {
                selector: false,
                element: false
            };
            this._dataValue = false;
            this.hash = false;
            this._reopen = false;
            this._selectorOpen = false;
            this.lastFocusEl = false;
            this._focusEl = [ "a[href]", 'input:not([disabled]):not([type="hidden"]):not([aria-hidden])', "button:not([disabled]):not([aria-hidden])", "select:not([disabled]):not([aria-hidden])", "textarea:not([disabled]):not([aria-hidden])", "area[href]", "iframe", "object", "embed", "[contenteditable]", '[tabindex]:not([tabindex^="-"])' ];
            this.options = {
                ...config,
                ...options,
                classes: {
                    ...config.classes,
                    ...options?.classes
                },
                hashSettings: {
                    ...config.hashSettings,
                    ...options?.hashSettings
                },
                on: {
                    ...config.on,
                    ...options?.on
                }
            };
            this.bodyLock = false;
            this.options.init ? this.initPopups() : null;
        }
        initPopups() {
            this.popupLogging(`Прокинувся`);
            this.eventsPopup();
        }
        eventsPopup() {
            document.addEventListener("click", function(e) {
                const buttonOpen = e.target.closest(`[${this.options.attributeOpenButton}]`);
                if (buttonOpen) {
                    e.preventDefault();
                    this._dataValue = buttonOpen.getAttribute(this.options.attributeOpenButton) ? buttonOpen.getAttribute(this.options.attributeOpenButton) : "error";
                    this.youTubeCode = buttonOpen.getAttribute(this.options.youtubeAttribute) ? buttonOpen.getAttribute(this.options.youtubeAttribute) : null;
                    if (this._dataValue !== "error") {
                        if (!this.isOpen) this.lastFocusEl = buttonOpen;
                        this.targetOpen.selector = `${this._dataValue}`;
                        this._selectorOpen = true;
                        this.open();
                        return;
                    } else this.popupLogging(`Ой, не заполнен атрибут в ${buttonOpen.classList}`);
                    return;
                }
                const buttonClose = e.target.closest(`[${this.options.attributeCloseButton}]`);
                if (buttonClose || !e.target.closest(`.${this.options.classes.popupContent}`) && this.isOpen) {
                    e.preventDefault();
                    this.close();
                    return;
                }
            }.bind(this));
            document.addEventListener("keydown", function(e) {
                if (this.options.closeEsc && e.which == 27 && e.code === "Escape" && this.isOpen) {
                    e.preventDefault();
                    this.close();
                    return;
                }
                if (this.options.focusCatch && e.which == 9 && this.isOpen) {
                    this._focusCatch(e);
                    return;
                }
            }.bind(this));
            if (this.options.hashSettings.goHash) {
                window.addEventListener("hashchange", function() {
                    if (window.location.hash) this._openToHash(); else this.close(this.targetOpen.selector);
                }.bind(this));
                window.addEventListener("load", function() {
                    if (window.location.hash) this._openToHash();
                }.bind(this));
            }
        }
        open(selectorValue) {
            if (bodyLockStatus) {
                this.bodyLock = document.documentElement.classList.contains("lock") && !this.isOpen ? true : false;
                if (selectorValue && typeof selectorValue === "string" && selectorValue.trim() !== "") {
                    this.targetOpen.selector = selectorValue;
                    this._selectorOpen = true;
                }
                if (this.isOpen) {
                    this._reopen = true;
                    this.close();
                }
                if (!this._selectorOpen) this.targetOpen.selector = this.lastClosed.selector;
                if (!this._reopen) this.previousActiveElement = document.activeElement;
                this.targetOpen.element = document.querySelector(this.targetOpen.selector);
                if (this.targetOpen.element) {
                    if (this.youTubeCode) {
                        const codeVideo = this.youTubeCode;
                        const urlVideo = `https://www.youtube.com/embed/${codeVideo}?rel=0&showinfo=0&autoplay=1`;
                        const iframe = document.createElement("iframe");
                        iframe.setAttribute("allowfullscreen", "");
                        const autoplay = this.options.setAutoplayYoutube ? "autoplay;" : "";
                        iframe.setAttribute("allow", `${autoplay}; encrypted-media`);
                        iframe.setAttribute("src", urlVideo);
                        if (!this.targetOpen.element.querySelector(`[${this.options.youtubePlaceAttribute}]`)) {
                            this.targetOpen.element.querySelector(".popup__text").setAttribute(`${this.options.youtubePlaceAttribute}`, "");
                        }
                        this.targetOpen.element.querySelector(`[${this.options.youtubePlaceAttribute}]`).appendChild(iframe);
                    }
                    if (this.options.hashSettings.location) {
                        this._getHash();
                        this._setHash();
                    }
                    this.options.on.beforeOpen(this);
                    document.dispatchEvent(new CustomEvent("beforePopupOpen", {
                        detail: {
                            popup: this
                        }
                    }));
                    this.targetOpen.element.classList.add(this.options.classes.popupActive);
                    document.documentElement.classList.add(this.options.classes.bodyActive);
                    if (!this._reopen) !this.bodyLock ? bodyLock() : null; else this._reopen = false;
                    this.targetOpen.element.setAttribute("aria-hidden", "false");
                    this.previousOpen.selector = this.targetOpen.selector;
                    this.previousOpen.element = this.targetOpen.element;
                    this._selectorOpen = false;
                    this.isOpen = true;
                    setTimeout(() => {
                        this._focusTrap();
                    }, 50);
                    this.options.on.afterOpen(this);
                    document.dispatchEvent(new CustomEvent("afterPopupOpen", {
                        detail: {
                            popup: this
                        }
                    }));
                    this.popupLogging(`Открыл попап`);
                } else this.popupLogging(`Ой.. такого попапа нет. Проверьте корректность ввода. `);
            }
        }
        close(selectorValue) {
            if (selectorValue && typeof selectorValue === "string" && selectorValue.trim() !== "") this.previousOpen.selector = selectorValue;
            if (!this.isOpen || !bodyLockStatus) return;
            this.options.on.beforeClose(this);
            document.dispatchEvent(new CustomEvent("beforePopupClose", {
                detail: {
                    popup: this
                }
            }));
            if (this.youTubeCode) if (this.targetOpen.element.querySelector(`[${this.options.youtubePlaceAttribute}]`)) this.targetOpen.element.querySelector(`[${this.options.youtubePlaceAttribute}]`).innerHTML = "";
            this.previousOpen.element.classList.remove(this.options.classes.popupActive);
            this.previousOpen.element.setAttribute("aria-hidden", "true");
            if (!this._reopen) {
                document.documentElement.classList.remove(this.options.classes.bodyActive);
                !this.bodyLock ? bodyUnlock() : null;
                this.isOpen = false;
            }
            this._removeHash();
            if (this._selectorOpen) {
                this.lastClosed.selector = this.previousOpen.selector;
                this.lastClosed.element = this.previousOpen.element;
            }
            this.options.on.afterClose(this);
            document.dispatchEvent(new CustomEvent("afterPopupClose", {
                detail: {
                    popup: this
                }
            }));
            setTimeout(() => {
                this._focusTrap();
            }, 50);
            this.popupLogging(`Закрыл попап`);
        }
        _getHash() {
            if (this.options.hashSettings.location) this.hash = this.targetOpen.selector.includes("#") ? this.targetOpen.selector : this.targetOpen.selector.replace(".", "#");
        }
        _openToHash() {
            const hash = window.location.hash;
            if (!hash || hash === "#") return;
            const hashValue = hash.replace("#", "");
            if (!hashValue) return;
            let classInHash = document.querySelector(`.${hashValue}`) ? `.${hashValue}` : document.querySelector(`#${hashValue}`) ? `#${hashValue}` : null;
            if (!classInHash) return;
            const buttons = document.querySelector(`[${this.options.attributeOpenButton}="${classInHash}"]`) || document.querySelector(`[${this.options.attributeOpenButton}="${classInHash.replace(".", "#")}"]`);
            if (!buttons) return;
            this.youTubeCode = buttons.getAttribute(this.options.youtubeAttribute) ? buttons.getAttribute(this.options.youtubeAttribute) : null;
            this.open(classInHash);
        }
        _setHash() {
            history.pushState("", "", this.hash);
        }
        _removeHash() {
            history.pushState("", "", window.location.href.split("#")[0]);
        }
        _focusCatch(e) {
            const focusable = this.targetOpen.element.querySelectorAll(this._focusEl);
            const focusArray = Array.prototype.slice.call(focusable);
            const focusedIndex = focusArray.indexOf(document.activeElement);
            if (e.shiftKey && focusedIndex === 0) {
                focusArray[focusArray.length - 1].focus();
                e.preventDefault();
            }
            if (!e.shiftKey && focusedIndex === focusArray.length - 1) {
                focusArray[0].focus();
                e.preventDefault();
            }
        }
        _focusTrap() {
            const focusable = this.previousOpen.element.querySelectorAll(this._focusEl);
            if (!this.isOpen && this.lastFocusEl) this.lastFocusEl.focus(); else if (focusable && focusable.length > 0) focusable[0].focus();
        }
        popupLogging(message) {
            this.options.logging ? FLS(`[Попапос]: ${message}`) : null;
        }
    }
    flsModules.popup = new Popup({});
    class ScrollWatcher {
        constructor(props) {
            let defaultConfig = {
                logging: true
            };
            this.config = Object.assign(defaultConfig, props);
            this.observer;
            !document.documentElement.classList.contains("watcher") ? this.scrollWatcherRun() : null;
        }
        scrollWatcherUpdate() {
            this.scrollWatcherRun();
        }
        scrollWatcherRun() {
            document.documentElement.classList.add("watcher");
            this.scrollWatcherConstructor(document.querySelectorAll("[data-watch]"));
        }
        scrollWatcherConstructor(items) {
            if (items.length) {
                this.scrollWatcherLogging(`Прокинувся, стежу за об'єктами (${items.length})...`);
                let uniqParams = uniqArray(Array.from(items).map(function(item) {
                    if (item.dataset.watch === "navigator" && !item.dataset.watchThreshold) {
                        let valueOfThreshold;
                        if (item.clientHeight > 2) {
                            valueOfThreshold = window.innerHeight / 2 / (item.clientHeight - 1);
                            if (valueOfThreshold > 1) valueOfThreshold = 1;
                        } else valueOfThreshold = 1;
                        item.setAttribute("data-watch-threshold", valueOfThreshold.toFixed(2));
                    }
                    return `${item.dataset.watchRoot ? item.dataset.watchRoot : null}|${item.dataset.watchMargin ? item.dataset.watchMargin : "0px"}|${item.dataset.watchThreshold ? item.dataset.watchThreshold : 0}`;
                }));
                uniqParams.forEach(uniqParam => {
                    let uniqParamArray = uniqParam.split("|");
                    let paramsWatch = {
                        root: uniqParamArray[0],
                        margin: uniqParamArray[1],
                        threshold: uniqParamArray[2]
                    };
                    let groupItems = Array.from(items).filter(function(item) {
                        let watchRoot = item.dataset.watchRoot ? item.dataset.watchRoot : null;
                        let watchMargin = item.dataset.watchMargin ? item.dataset.watchMargin : "0px";
                        let watchThreshold = item.dataset.watchThreshold ? item.dataset.watchThreshold : 0;
                        if (String(watchRoot) === paramsWatch.root && String(watchMargin) === paramsWatch.margin && String(watchThreshold) === paramsWatch.threshold) return item;
                    });
                    let configWatcher = this.getScrollWatcherConfig(paramsWatch);
                    this.scrollWatcherInit(groupItems, configWatcher);
                });
            } else this.scrollWatcherLogging("Сплю, нет объектов для слежки. ZzzZZzz");
        }
        getScrollWatcherConfig(paramsWatch) {
            let configWatcher = {};
            if (document.querySelector(paramsWatch.root)) configWatcher.root = document.querySelector(paramsWatch.root); else if (paramsWatch.root !== "null") this.scrollWatcherLogging(`Эмм... родительского объекта ${paramsWatch.root} нет на странице`);
            configWatcher.rootMargin = paramsWatch.margin;
            if (paramsWatch.margin.indexOf("px") < 0 && paramsWatch.margin.indexOf("%") < 0) {
                this.scrollWatcherLogging(`ой, настройку data-watch-margin нужно задавать в PX или %`);
                return;
            }
            if (paramsWatch.threshold === "prx") {
                paramsWatch.threshold = [];
                for (let i = 0; i <= 1; i += .005) paramsWatch.threshold.push(i);
            } else paramsWatch.threshold = paramsWatch.threshold.split(",");
            configWatcher.threshold = paramsWatch.threshold;
            return configWatcher;
        }
        scrollWatcherCreate(configWatcher) {
            this.observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    this.scrollWatcherCallback(entry, observer);
                });
            }, configWatcher);
        }
        scrollWatcherInit(items, configWatcher) {
            this.scrollWatcherCreate(configWatcher);
            items.forEach(item => this.observer.observe(item));
        }
        scrollWatcherIntersecting(entry, targetElement) {
            if (entry.isIntersecting) {
                !targetElement.classList.contains("_watcher-view") ? targetElement.classList.add("_watcher-view") : null;
                this.scrollWatcherLogging(`я вижу ${targetElement.classList}, добавил класс _watcher-view`);
            } else {
                targetElement.classList.contains("_watcher-view") ? targetElement.classList.remove("_watcher-view") : null;
                this.scrollWatcherLogging(`я не вижу${targetElement.classList}, убрал класс _watcher-view`);
            }
        }
        scrollWatcherOff(targetElement, observer) {
            observer.unobserve(targetElement);
            this.scrollWatcherLogging(`Я перестал следить за ${targetElement.classList}`);
        }
        scrollWatcherLogging(message) {
            this.config.logging ? FLS(`[Наблюдатель]: ${message}`) : null;
        }
        scrollWatcherCallback(entry, observer) {
            const targetElement = entry.target;
            this.scrollWatcherIntersecting(entry, targetElement);
            targetElement.hasAttribute("data-watch-once") && entry.isIntersecting ? this.scrollWatcherOff(targetElement, observer) : null;
            document.dispatchEvent(new CustomEvent("watcherCallback", {
                detail: {
                    entry
                }
            }));
        }
    }
    flsModules.watcher = new ScrollWatcher({});
    class DynamicAdapt {
        constructor(type) {
            this.type = type;
        }
        init() {
            this.оbjects = [];
            this.daClassname = "_dynamic_adapt_";
            this.nodes = [ ...document.querySelectorAll("[data-da]") ];
            this.nodes.forEach(node => {
                const data = node.dataset.da.trim();
                const dataArray = data.split(",");
                const оbject = {};
                оbject.element = node;
                оbject.parent = node.parentNode;
                оbject.destination = document.querySelector(`${dataArray[0].trim()}`);
                оbject.breakpoint = dataArray[1] ? dataArray[1].trim() : "767.98";
                оbject.place = dataArray[2] ? dataArray[2].trim() : "last";
                оbject.index = this.indexInParent(оbject.parent, оbject.element);
                this.оbjects.push(оbject);
            });
            this.arraySort(this.оbjects);
            this.mediaQueries = this.оbjects.map(({breakpoint}) => `(${this.type}-width: ${breakpoint / 16}em),${breakpoint}`).filter((item, index, self) => self.indexOf(item) === index);
            this.mediaQueries.forEach(media => {
                const mediaSplit = media.split(",");
                const matchMedia = window.matchMedia(mediaSplit[0]);
                const mediaBreakpoint = mediaSplit[1];
                const оbjectsFilter = this.оbjects.filter(({breakpoint}) => breakpoint === mediaBreakpoint);
                matchMedia.addEventListener("change", () => {
                    this.mediaHandler(matchMedia, оbjectsFilter);
                });
                this.mediaHandler(matchMedia, оbjectsFilter);
            });
        }
        mediaHandler(matchMedia, оbjects) {
            if (matchMedia.matches) оbjects.forEach(оbject => {
                this.moveTo(оbject.place, оbject.element, оbject.destination);
            }); else оbjects.forEach(({parent, element, index}) => {
                if (element.classList.contains(this.daClassname)) this.moveBack(parent, element, index);
            });
        }
        moveTo(place, element, destination) {
            element.classList.add(this.daClassname);
            if (place === "last" || place >= destination.children.length) {
                destination.append(element);
                return;
            }
            if (place === "first") {
                destination.prepend(element);
                return;
            }
            destination.children[place].before(element);
        }
        moveBack(parent, element, index) {
            element.classList.remove(this.daClassname);
            if (parent.children[index] !== void 0) parent.children[index].before(element); else parent.append(element);
        }
        indexInParent(parent, element) {
            return [ ...parent.children ].indexOf(element);
        }
        arraySort(arr) {
            if (this.type === "min") arr.sort((a, b) => {
                if (a.breakpoint === b.breakpoint) {
                    if (a.place === b.place) return 0;
                    if (a.place === "first" || b.place === "last") return -1;
                    if (a.place === "last" || b.place === "first") return 1;
                    return 0;
                }
                return a.breakpoint - b.breakpoint;
            }); else {
                arr.sort((a, b) => {
                    if (a.breakpoint === b.breakpoint) {
                        if (a.place === b.place) return 0;
                        if (a.place === "first" || b.place === "last") return 1;
                        if (a.place === "last" || b.place === "first") return -1;
                        return 0;
                    }
                    return b.breakpoint - a.breakpoint;
                });
                return;
            }
        }
    }
    const da = new DynamicAdapt("max");
    da.init();
    document.addEventListener("DOMContentLoaded", () => {
        let lastScroll = 0;
        const header = document.querySelector(".header");
        const scrollOffset = 80;
        if (!header) return;
        window.addEventListener("scroll", () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll <= 0) {
                header.classList.remove("_hide");
                return;
            }
            if (currentScroll > lastScroll && currentScroll > scrollOffset) header.classList.add("_hide"); else header.classList.remove("_hide");
            lastScroll = currentScroll;
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const wrapper = document.querySelector(".wrapper");
        const dropdownItems = document.querySelectorAll(".menu__item--has-dropdown");
        function handleDropdownHover(isHovering) {
            if (isHovering) wrapper.classList.add("dropdown-active"); else {
                const hasActiveDropdown = Array.from(dropdownItems).some(item => item.matches(":hover"));
                const isDropdownHovered = Array.from(document.querySelectorAll(".menu__dropdown")).some(dropdown => dropdown.matches(":hover"));
                if (!hasActiveDropdown && !isDropdownHovered) wrapper.classList.remove("dropdown-active");
            }
        }
        dropdownItems.forEach(item => {
            item.addEventListener("mouseenter", () => {
                handleDropdownHover(true);
            });
            item.addEventListener("mouseleave", e => {
                const relatedTarget = e.relatedTarget;
                const dropdown = item.querySelector(".menu__dropdown");
                if (dropdown && dropdown.contains(relatedTarget)) return;
                handleDropdownHover(false);
            });
        });
        document.querySelectorAll(".header__dropdown").forEach(dropdown => {
            dropdown.addEventListener("mouseenter", () => {
                handleDropdownHover(true);
            });
            dropdown.addEventListener("mouseleave", () => {
                handleDropdownHover(false);
            });
        });
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && wrapper.classList.contains("dropdown-active")) wrapper.classList.remove("dropdown-active");
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const wrapper = document.querySelector(".wrapper");
        const searchWrapper = document.querySelector(".header__search");
        const searchInput = document.querySelector(".header__search-input input");
        const searchContent = document.querySelector(".header__search-content");
        const searchItems = document.querySelectorAll(".header__search-item");
        const clearBtn = document.querySelector(".header__search-btn--clear");
        const searchBtn = document.querySelector(".header__search-btn--search");
        let searchTimeout;
        let blurTimeout;
        let closeTimeout;
        let isMobileFocus = false;
        let lastInputValue = "";
        const mobileBreakpoint = 1100;
        function isMobile() {
            return window.innerWidth <= mobileBreakpoint;
        }
        function showContent() {
            clearTimeout(searchTimeout);
            clearTimeout(closeTimeout);
            searchContent.classList.add("active");
            if (wrapper) wrapper.classList.add("search-active");
        }
        function hideContent() {
            searchContent.classList.remove("active");
            if (wrapper) wrapper.classList.remove("search-active");
        }
        function updateClearButton() {
            const hasValue = searchInput.value.trim().length > 0;
            requestAnimationFrame(() => {
                if (hasValue) searchWrapper.classList.add("has-value"); else searchWrapper.classList.remove("has-value");
            });
        }
        function closeMobileSearch() {
            if (!isMobile()) return;
            hideContent();
            clearTimeout(closeTimeout);
            closeTimeout = setTimeout(() => {
                searchWrapper.classList.remove("active");
                searchInput.blur();
                if (searchInput.value.trim()) {
                    searchInput.value = "";
                    updateClearButton();
                }
            }, 150);
        }
        searchInput.addEventListener("input", function(e) {
            const query = e.target.value;
            const trimmedQuery = query.trim();
            clearTimeout(searchTimeout);
            clearTimeout(closeTimeout);
            requestAnimationFrame(() => {
                updateClearButton();
            });
            if (trimmedQuery !== "") showContent(); else hideContent();
            lastInputValue = trimmedQuery;
        });
        searchInput.addEventListener("focus", function() {
            clearTimeout(closeTimeout);
            clearTimeout(blurTimeout);
            if (!isMobile() || searchWrapper.classList.contains("active")) searchWrapper.classList.add("active");
            if (this.value.trim() !== "") showContent();
        });
        searchInput.addEventListener("blur", function() {
            if (isMobileFocus) {
                isMobileFocus = false;
                return;
            }
            blurTimeout = setTimeout(() => {
                if (!searchInput.value.trim()) if (isMobile()) closeMobileSearch(); else {
                    searchWrapper.classList.remove("active");
                    hideContent();
                } else if (!isMobile()) searchWrapper.classList.remove("active");
            }, 200);
        });
        searchBtn.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            clearTimeout(closeTimeout);
            if (isMobile() && !searchWrapper.classList.contains("active")) {
                searchWrapper.classList.add("active");
                isMobileFocus = true;
                requestAnimationFrame(() => {
                    searchInput.focus();
                    setTimeout(() => {
                        isMobileFocus = false;
                    }, 100);
                });
                return;
            }
            searchInput.focus();
        });
        searchWrapper.addEventListener("mousedown", function(e) {
            e.stopPropagation();
        });
        clearBtn.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (window.navigator && window.navigator.vibrate) window.navigator.vibrate(10);
            searchInput.value = "";
            requestAnimationFrame(() => {
                updateClearButton();
            });
            hideContent();
            if (isMobile()) closeMobileSearch(); else {
                searchWrapper.classList.remove("active");
                if (document.activeElement === searchInput) searchWrapper.classList.add("active");
            }
            searchInput.dispatchEvent(new Event("input", {
                bubbles: true
            }));
        });
        searchItems.forEach(item => {
            item.addEventListener("click", function() {
                const textElement = this.querySelector(".text._black");
                if (!textElement) return;
                const selectedText = textElement.textContent.trim();
                searchInput.value = selectedText;
                requestAnimationFrame(() => {
                    updateClearButton();
                });
                if (isMobile()) closeMobileSearch(); else {
                    hideContent();
                    searchWrapper.classList.remove("active");
                    searchInput.blur();
                }
                searchInput.dispatchEvent(new Event("input", {
                    bubbles: true
                }));
            });
        });
        document.addEventListener("click", function(e) {
            if (e.target.closest(".header__search-btn--search")) return;
            if (!searchWrapper.contains(e.target)) {
                clearTimeout(blurTimeout);
                if (isMobile()) closeMobileSearch(); else {
                    hideContent();
                    if (!searchInput.value.trim()) {
                        searchWrapper.classList.remove("active");
                        searchWrapper.classList.remove("has-value");
                    } else searchWrapper.classList.remove("active");
                }
            }
        });
        searchInput.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                e.preventDefault();
                if (isMobile()) closeMobileSearch(); else {
                    hideContent();
                    if (!searchInput.value.trim()) searchWrapper.classList.remove("has-value");
                    searchWrapper.classList.remove("active");
                    this.blur();
                }
            }
        });
        let resizeTimeout;
        window.addEventListener("resize", function() {
            clearTimeout(resizeTimeout);
            clearTimeout(closeTimeout);
            resizeTimeout = setTimeout(() => {
                if (!isMobile() && searchWrapper.classList.contains("active") && !searchInput.value.trim()) searchWrapper.classList.remove("active");
                if (!isMobile() && searchContent.classList.contains("active") && !searchInput.value.trim()) hideContent();
            }, 100);
        });
        updateClearButton();
        if (searchInput.value.trim()) searchWrapper.classList.add("has-value");
    });
    document.addEventListener("DOMContentLoaded", function() {
        const searchBtnMobile = document.querySelector(".header__search-btn-mobile");
        const mobileSearch = document.querySelector(".mobile-search");
        const mobileInput = document.querySelector(".mobile-search__input");
        const mobileContent = document.querySelector(".mobile-search__content");
        const mobileClear = document.querySelector(".mobile-search__btn--clear");
        const mobileItems = document.querySelectorAll(".mobile-search__item");
        const header = document.querySelector(".header");
        const wrapper = document.querySelector(".wrapper");
        function openMobileSearch() {
            if (mobileSearch) {
                mobileSearch.classList.add("active");
                header.classList.add("search-open");
                if (wrapper) wrapper.classList.add("search-active");
                setTimeout(() => {
                    if (mobileInput) mobileInput.focus();
                }, 300);
            }
        }
        function closeMobileSearch() {
            if (mobileSearch) {
                mobileSearch.classList.remove("active");
                header.classList.remove("search-open");
                if (wrapper) wrapper.classList.remove("search-active");
                if (mobileInput) {
                    mobileInput.value = "";
                    mobileSearch.classList.remove("has-value");
                }
                if (mobileContent) mobileContent.classList.remove("active");
            }
        }
        if (searchBtnMobile) searchBtnMobile.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (mobileSearch) if (mobileSearch.classList.contains("active")) closeMobileSearch(); else openMobileSearch();
        });
        if (mobileClear) mobileClear.addEventListener("click", function(e) {
            e.stopPropagation();
            if (mobileInput) if (mobileInput.value.trim().length > 0) {
                mobileInput.value = "";
                mobileInput.focus();
                mobileSearch.classList.remove("has-value");
                if (mobileContent) mobileContent.classList.remove("active");
            } else closeMobileSearch();
        });
        if (mobileInput) {
            mobileInput.addEventListener("input", function() {
                const query = this.value.trim();
                if (query.length > 0) {
                    mobileSearch.classList.add("has-value");
                    if (mobileContent) mobileContent.classList.add("active");
                } else {
                    mobileSearch.classList.remove("has-value");
                    if (mobileContent) mobileContent.classList.remove("active");
                }
            });
            mobileInput.addEventListener("keydown", function(e) {
                if (e.key === "Escape") if (this.value.trim().length > 0) {
                    this.value = "";
                    mobileSearch.classList.remove("has-value");
                    if (mobileContent) mobileContent.classList.remove("active");
                    this.focus();
                } else {
                    closeMobileSearch();
                    this.blur();
                }
                if (e.key === "Enter") e.preventDefault();
            });
        }
        mobileItems.forEach(item => {
            item.addEventListener("click", function() {
                const textElement = this.querySelector(".text-caption");
                if (textElement && mobileInput) {
                    mobileInput.value = textElement.textContent.trim();
                    mobileSearch.classList.add("has-value");
                    setTimeout(() => {
                        closeMobileSearch();
                    }, 500);
                }
            });
        });
        document.addEventListener("click", function(e) {
            if (mobileSearch && mobileSearch.classList.contains("active")) if (!mobileSearch.contains(e.target) && !searchBtnMobile.contains(e.target)) closeMobileSearch();
        });
        window.addEventListener("resize", function() {
            if (window.innerWidth > 768 && mobileSearch && mobileSearch.classList.contains("active")) closeMobileSearch();
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const upButton = document.getElementById("upButton");
        if (!upButton) return;
        window.addEventListener("scroll", () => {
            upButton.classList.toggle("show", window.scrollY > 500);
        });
        upButton.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    });
    document.addEventListener("DOMContentLoaded", () => {
        const blocks = document.querySelectorAll(".sort__block");
        const isTouch = "ontouchstart" in window || navigator.maxTouchPoints > 0;
        blocks.forEach(block => {
            const btn = block.querySelector(".button-sort");
            const content = block.querySelector(".sort__content");
            const btnText = btn.querySelector("span");
            const radios = content.querySelectorAll('input[type="radio"]');
            let checked = content.querySelector('input[type="radio"]:checked') || radios[0];
            if (checked && !checked.checked) checked.checked = true;
            if (checked) btnText.textContent = checked.nextElementSibling.textContent;
            const close = () => {
                content.classList.remove("active");
                block.classList.remove("is-open");
            };
            const open = () => {
                document.querySelectorAll(".sort__content.active").forEach(c => {
                    if (c !== content) c.classList.remove("active");
                });
                document.querySelectorAll(".sort__block.is-open").forEach(b => {
                    if (b !== block) b.classList.remove("is-open");
                });
                content.classList.add("active");
                block.classList.add("is-open");
            };
            btn.addEventListener("click", e => {
                e.preventDefault();
                e.stopPropagation();
                if (isTouch) if (content.classList.contains("active")) close(); else open();
            });
            content.addEventListener("change", e => {
                const target = e.target;
                if (!target.matches('input[type="radio"]')) return;
                content.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
                target.checked = true;
                const label = target.closest("label");
                if (label) {
                    btnText.textContent = label.querySelector("span").textContent;
                    content.querySelectorAll("label").forEach(l => l.classList.remove("active"));
                    label.classList.add("active");
                }
                if (isTouch) close();
            });
            document.addEventListener("click", e => {
                if (!block.contains(e.target)) close();
            });
            document.addEventListener("keydown", e => {
                if (e.key === "Escape") close();
            });
            const initialChecked = content.querySelector('input[type="radio"]:checked');
            if (initialChecked) {
                const parentLabel = initialChecked.closest("label");
                if (parentLabel) parentLabel.classList.add("active");
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const filterButton = document.querySelector(".button-filter");
        const mobileFilter = document.querySelector(".page__mobile-filter");
        function openFilter() {
            if (!mobileFilter) return;
            mobileFilter.classList.add("_active");
            document.body.classList.add("_lock");
            let overlay = document.querySelector(".filter-overlay");
            if (!overlay) {
                overlay = document.createElement("div");
                overlay.className = "filter-overlay";
                document.body.appendChild(overlay);
                overlay.addEventListener("click", closeFilter);
            }
            setTimeout(() => overlay.classList.add("_active"), 10);
        }
        function closeFilter() {
            if (!mobileFilter) return;
            mobileFilter.classList.remove("_active");
            document.body.classList.remove("_lock");
            const overlay = document.querySelector(".filter-overlay");
            if (overlay) {
                overlay.classList.remove("_active");
                setTimeout(() => overlay.remove(), 300);
            }
        }
        if (filterButton) filterButton.addEventListener("click", openFilter);
        document.addEventListener("click", function(e) {
            const closeBtn = e.target.closest("[data-close]");
            if (closeBtn) closeFilter();
        });
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && mobileFilter && mobileFilter.classList.contains("_active")) closeFilter();
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".wrapper");
        const searchWrapper = document.querySelector(".page__sidebar-search");
        const searchInput = document.querySelector(".page__sidebar-search-input input");
        const clearBtn = document.querySelector(".page__sidebar-search-btn--clear");
        const searchBtn = document.querySelector(".page__sidebar-search-btn--search");
        if (!searchWrapper || !searchInput) {
            console.warn("Search elements not found");
            return;
        }
        function updateClearButton() {
            const hasValue = searchInput.value.trim().length > 0;
            requestAnimationFrame(() => {
                if (hasValue) searchWrapper.classList.add("has-value"); else searchWrapper.classList.remove("has-value");
            });
        }
        function clearSearch() {
            searchInput.value = "";
            updateClearButton();
            searchInput.focus();
            searchInput.dispatchEvent(new Event("input", {
                bubbles: true
            }));
            searchInput.dispatchEvent(new Event("change", {
                bubbles: true
            }));
        }
        searchInput.addEventListener("input", function() {
            updateClearButton();
        });
        searchInput.addEventListener("focus", function() {
            searchWrapper.classList.add("active");
            updateClearButton();
        });
        searchInput.addEventListener("blur", function() {
            setTimeout(() => {
                if (!searchInput.value.trim()) searchWrapper.classList.remove("active");
            }, 200);
        });
        if (clearBtn) clearBtn.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            clearSearch();
        });
        if (searchBtn) searchBtn.addEventListener("click", function(e) {
            e.preventDefault();
            searchInput.focus();
        });
        document.addEventListener("click", function(e) {
            if (!searchWrapper.contains(e.target)) if (!searchInput.value.trim()) {
                searchWrapper.classList.remove("active");
                searchWrapper.classList.remove("has-value");
            } else searchWrapper.classList.remove("active");
        });
        searchInput.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                e.preventDefault();
                searchInput.blur();
                if (!searchInput.value.trim()) {
                    searchWrapper.classList.remove("active");
                    searchWrapper.classList.remove("has-value");
                } else searchWrapper.classList.remove("active");
            }
        });
        updateClearButton();
    });
    document.addEventListener("DOMContentLoaded", function() {
        const subnav = document.querySelector(".home__subnav");
        const footer = document.querySelector("footer");
        if (!subnav || !footer) return;
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    subnav.style.position = "absolute";
                    subnav.style.top = "auto";
                    subnav.style.bottom = footer.offsetHeight + 20 + "px";
                } else {
                    subnav.style.position = "sticky";
                    subnav.style.top = "30px";
                    subnav.style.bottom = "auto";
                }
            });
        }, {
            root: null,
            threshold: 0,
            rootMargin: "0px 0px -50px 0px"
        });
        observer.observe(footer);
    });
    document.addEventListener("DOMContentLoaded", () => {
        const langContainer = document.querySelector(".header__lang");
        const navElement = document.querySelector(".header__nav");
        if (!langContainer) return;
        const langBtn = langContainer.querySelector(".header__lang-btn");
        const langCurrent = langContainer.querySelector(".header__lang-current");
        const langOptions = langContainer.querySelectorAll(".header__lang-option");
        function setNavZIndex(isLangOpen) {
            if (!navElement) return;
            if (isLangOpen) navElement.style.zIndex = "-1"; else navElement.style.zIndex = "";
        }
        function setLangOpenState(isOpen) {
            if (isOpen) {
                langContainer.classList.add("open");
                setNavZIndex(true);
            } else {
                langContainer.classList.remove("open");
                setNavZIndex(false);
            }
        }
        function repositionDropdownOptions() {
            const nonActiveOptions = Array.from(langOptions).filter(opt => !opt.classList.contains("active"));
            nonActiveOptions.forEach(opt => {
                opt.style.removeProperty("--option-index");
            });
            nonActiveOptions.forEach((opt, idx) => {
                opt.style.setProperty("--option-index", idx + 1);
            });
            const totalOptions = langOptions.length;
            langContainer.style.setProperty("--lang-count", totalOptions);
        }
        function setCurrentLang(lang) {
            langCurrent.textContent = lang.toUpperCase();
            langOptions.forEach(option => {
                const optionLang = option.getAttribute("data-lang");
                if (optionLang === lang) option.classList.add("active"); else option.classList.remove("active");
            });
            repositionDropdownOptions();
            localStorage.setItem("preferred-language", lang);
        }
        function initCurrentLang() {
            const activeOption = Array.from(langOptions).find(opt => opt.classList.contains("active"));
            if (activeOption) {
                const activeLang = activeOption.getAttribute("data-lang");
                langCurrent.textContent = activeLang.toUpperCase();
            } else if (langOptions.length > 0) {
                const firstLang = langOptions[0].getAttribute("data-lang");
                setCurrentLang(firstLang);
            }
            repositionDropdownOptions();
        }
        langBtn.addEventListener("click", e => {
            e.preventDefault();
            e.stopPropagation();
            const willBeOpen = !langContainer.classList.contains("open");
            setLangOpenState(willBeOpen);
            if (willBeOpen) repositionDropdownOptions();
        });
        let hoverTimer;
        langContainer.addEventListener("mouseenter", () => {
            clearTimeout(hoverTimer);
            setLangOpenState(true);
            repositionDropdownOptions();
        });
        langContainer.addEventListener("mouseleave", () => {
            hoverTimer = setTimeout(() => {
                setLangOpenState(false);
            }, 100);
        });
        const dropdown = langContainer.querySelector(".header__lang-dropdown");
        if (dropdown) {
            dropdown.addEventListener("mouseenter", () => {
                clearTimeout(hoverTimer);
            });
            dropdown.addEventListener("mouseleave", () => {
                hoverTimer = setTimeout(() => {
                    setLangOpenState(false);
                }, 100);
            });
        }
        langOptions.forEach(option => {
            option.addEventListener("click", e => {
                e.preventDefault();
                e.stopPropagation();
                const selectedLang = option.getAttribute("data-lang");
                const currentLang = langCurrent.textContent.toLowerCase();
                if (selectedLang !== currentLang) {
                    setCurrentLang(selectedLang);
                    const langChangeEvent = new CustomEvent("languageChanged", {
                        detail: {
                            language: selectedLang
                        }
                    });
                    document.dispatchEvent(langChangeEvent);
                }
                setTimeout(() => {
                    setLangOpenState(false);
                }, 200);
            });
        });
        document.addEventListener("click", e => {
            if (!langContainer.contains(e.target)) setLangOpenState(false);
        });
        document.addEventListener("keydown", e => {
            if (e.key === "Escape" && langContainer.classList.contains("open")) setLangOpenState(false);
        });
        initCurrentLang();
        let resizeTimer;
        window.addEventListener("resize", () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (langContainer.classList.contains("open")) repositionDropdownOptions();
            }, 150);
        });
        const observer = new MutationObserver(() => {
            repositionDropdownOptions();
        });
        observer.observe(langContainer, {
            childList: true,
            subtree: true
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const subnavItems = document.querySelectorAll(".home__subnav-list-item");
        let activeItem = null;
        let timeoutId = null;
        subnavItems.forEach(item => {
            const link = item.querySelector("a");
            item.addEventListener("mouseenter", function(e) {
                if (timeoutId) {
                    clearTimeout(timeoutId);
                    timeoutId = null;
                }
                if (activeItem && activeItem !== this) activeItem.querySelector("a").classList.remove("is-active");
                link.classList.add("is-active");
                activeItem = this;
            });
            item.addEventListener("mouseleave", function(e) {
                timeoutId = setTimeout(() => {
                    link.classList.remove("is-active");
                    activeItem = null;
                    timeoutId = null;
                }, 300);
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const phoneInputs = document.querySelectorAll(".phone-mask");
        phoneInputs.forEach(function(phoneInput) {
            if (!phoneInput) return;
            const mask = "+375 (__) ___ - __ - __";
            let digits = "";
            function updateInput() {
                let res = "";
                let di = 0;
                for (let i = 0; i < mask.length; i++) if (mask[i] === "_") res += di < digits.length ? digits[di++] : "_"; else res += mask[i];
                phoneInput.value = res;
                phoneInput.setAttribute("data-raw-digits", digits);
            }
            function getCursor() {
                let count = 0;
                for (let i = 0; i < mask.length; i++) if (mask[i] === "_") {
                    if (count === digits.length) return i < 5 ? 5 : i;
                    count++;
                }
                return mask.length;
            }
            function setCursor() {
                const pos = getCursor();
                phoneInput.setSelectionRange(pos, pos);
            }
            phoneInput.addEventListener("input", function() {
                let value = phoneInput.value.replace("+375", "");
                let numbers = value.replace(/\D/g, "");
                digits = numbers.slice(0, 9);
                updateInput();
                setCursor();
                this.classList.remove("error");
                removeErrorMessage(this);
            });
            phoneInput.addEventListener("keydown", function(e) {
                const start = phoneInput.selectionStart;
                const end = phoneInput.selectionEnd;
                if (e.key === "Backspace") {
                    if (start !== end) digits = ""; else if (digits.length > 0) digits = digits.slice(0, -1);
                    updateInput();
                    setCursor();
                    e.preventDefault();
                }
                if (e.key === "Delete") {
                    if (start !== end) {
                        digits = "";
                        updateInput();
                        setCursor();
                    }
                    e.preventDefault();
                }
            });
            phoneInput.addEventListener("focus", function() {
                updateInput();
                setCursor();
            });
            phoneInput.addEventListener("click", function(e) {
                e.preventDefault();
                setCursor();
            });
            phoneInput.addEventListener("paste", function(e) {
                e.preventDefault();
                let paste = (e.clipboardData || window.clipboardData).getData("text");
                let numbers = paste.replace(/\D/g, "");
                digits = numbers.slice(0, 9);
                updateInput();
                setCursor();
            });
            updateInput();
        });
        document.querySelectorAll(".radio-block").forEach(block => {
            const radio = block.querySelector(".radio");
            const label = block.querySelector(".radio-label");
            if (radio && label) {
                const handleClick = function(e) {
                    if (!e.target.closest("input")) {
                        radio.checked = true;
                        const changeEvent = new Event("change", {
                            bubbles: true
                        });
                        radio.dispatchEvent(changeEvent);
                        const parentBlock = block.closest(".form__line-block[data-error]");
                        if (parentBlock) {
                            parentBlock.classList.remove("has-error");
                            removeErrorMessage(parentBlock);
                        }
                    }
                };
                block.addEventListener("click", handleClick);
                label.addEventListener("click", function(e) {
                    e.stopPropagation();
                });
            }
        });
        function removeErrorMessage(element) {
            const parent = element.closest ? element.closest(".form__line") : element.parentElement;
            if (parent) {
                const errorMsg = parent.querySelector(".error-message");
                if (errorMsg) errorMsg.remove();
            }
            const block = element.closest ? element.closest(".form__line-block") : null;
            if (block) {
                const errorMsg = block.querySelector(".error-message");
                if (errorMsg) errorMsg.remove();
            }
        }
        function showErrorMessage(field, message) {
            field.classList.add("error");
            const parentLine = field.closest(".form__line");
            if (parentLine && !parentLine.querySelector(".error-message")) {
                const errorDiv = document.createElement("div");
                errorDiv.className = "error-message";
                errorDiv.textContent = message;
                parentLine.appendChild(errorDiv);
            }
        }
        function showErrorMessageInBlock(block, message) {
            block.classList.add("has-error");
            if (!block.querySelector(".error-message")) {
                const errorDiv = document.createElement("div");
                errorDiv.className = "error-message";
                errorDiv.textContent = message;
                block.appendChild(errorDiv);
            }
        }
        const popupForm = document.querySelector(".popup__form form");
        if (popupForm) {
            function validatePopupForm() {
                let isValid = true;
                popupForm.querySelectorAll(".error-message").forEach(el => el.remove());
                popupForm.querySelectorAll(".error").forEach(el => el.classList.remove("error"));
                popupForm.querySelectorAll(".has-error").forEach(el => el.classList.remove("has-error"));
                const nameInput = popupForm.querySelector('input[name="name"]');
                if (nameInput) {
                    const value = nameInput.value.trim();
                    if (!value || value.length < 2) {
                        isValid = false;
                        showErrorMessage(nameInput, "Обязательно для заполнения");
                    }
                }
                const phoneInputsInPopup = popupForm.querySelectorAll(".phone-mask");
                phoneInputsInPopup.forEach((phoneInput, index) => {
                    const rawDigits = phoneInput.getAttribute("data-raw-digits") || phoneInput.value.replace(/\D/g, "");
                    const parentLine = phoneInput.closest(".form__line");
                    const label = parentLine ? parentLine.querySelector("label") : null;
                    const isRequired = label && label.innerHTML.includes("*");
                    if (isRequired || index === 0) if (rawDigits.length !== 9) {
                        isValid = false;
                        showErrorMessage(phoneInput, "Обязательно для заполнения");
                    }
                });
                const emailInputs = popupForm.querySelectorAll('input[type="email"]');
                emailInputs.forEach((emailInput, index) => {
                    const parentLine = emailInput.closest(".form__line");
                    const label = parentLine ? parentLine.querySelector("label") : null;
                    const isRequired = label && label.innerHTML.includes("*");
                    if (isRequired || index === 0) {
                        const value = emailInput.value.trim();
                        if (!value) {
                            isValid = false;
                            showErrorMessage(emailInput, "Обязательно для заполнения");
                        } else {
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(value)) {
                                isValid = false;
                                showErrorMessage(emailInput, "Введите корректный email адрес");
                            }
                        }
                    }
                });
                const addressInput = popupForm.querySelector('input[name="address"]');
                if (addressInput && addressInput.hasAttribute("data-error")) {
                    const value = addressInput.value.trim();
                    if (!value) {
                        isValid = false;
                        showErrorMessage(addressInput, "Обязательно для заполнения");
                    }
                }
                const educationBlock = popupForm.querySelector(".form__line-block[data-error]");
                if (educationBlock) {
                    const radios = educationBlock.querySelectorAll('input[type="radio"]');
                    const isChecked = Array.from(radios).some(radio => radio.checked);
                    if (!isChecked) {
                        isValid = false;
                        showErrorMessageInBlock(educationBlock, "Обязательно для заполнения");
                    }
                }
                const representativeInput = popupForm.querySelector('input[placeholder*="законного представителя"]');
                if (representativeInput) {
                    const value = representativeInput.value.trim();
                    if (!value || value.length < 2) {
                        isValid = false;
                        showErrorMessage(representativeInput, "Обязательно для заполнения");
                    }
                }
                const captchaInput = popupForm.querySelector('input[placeholder=""]');
                if (captchaInput && captchaInput.closest(".form__line")?.querySelector("label")?.innerHTML.includes("символы")) {
                    const value = captchaInput.value.trim();
                    if (!value) {
                        isValid = false;
                        showErrorMessage(captchaInput, "Обязательно для заполнения");
                    }
                }
                return isValid;
            }
            popupForm.addEventListener("submit", function(e) {
                e.preventDefault();
                const formData = {};
                this.querySelectorAll('input:not([type="radio"])').forEach(field => {
                    if (field.name && field.value) {
                        const rawDigits = field.getAttribute("data-raw-digits");
                        if (rawDigits !== null) formData[field.name] = rawDigits; else formData[field.name] = field.value.trim();
                    }
                });
                this.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                    const parentBlock = radio.closest(".form__line-block");
                    if (parentBlock) {
                        const label = parentBlock.querySelector("p")?.textContent || radio.value;
                        formData["education"] = label;
                    } else formData[radio.name] = radio.value;
                });
                if (validatePopupForm()) {
                    const popup = document.querySelector(".popup");
                    if (popup) {
                        popup.classList.remove("popup_show");
                        popup.setAttribute("aria-hidden", "true");
                    }
                } else {
                    const firstError = this.querySelector(".error, .has-error");
                    if (firstError) firstError.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });
                }
            });
            popupForm.querySelectorAll("input").forEach(input => {
                const removeError = function() {
                    this.classList.remove("error");
                    const parentLine = this.closest(".form__line");
                    if (parentLine) {
                        const errorMsg = parentLine.querySelector(".error-message");
                        if (errorMsg) errorMsg.remove();
                    }
                    const parentBlock = this.closest(".form__line-block[data-error]");
                    if (parentBlock) {
                        const errorMsg = parentBlock.querySelector(".error-message");
                        if (errorMsg) errorMsg.remove();
                        parentBlock.classList.remove("has-error");
                    }
                };
                input.addEventListener("input", removeError);
                input.addEventListener("change", removeError);
            });
        }
        const popup = document.querySelector(".popup");
        const header = document.querySelector(".header");
        if (popup && header) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === "class") if (popup.classList.contains("popup_show")) header.classList.add("_hide"); else header.classList.remove("_hide");
                });
            });
            observer.observe(popup, {
                attributes: true,
                attributeFilter: [ "class" ]
            });
            if (popup.classList.contains("popup_show")) header.classList.add("_hide");
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
        const tabsContainer = document.querySelector(".tabs");
        const servicesList = document.querySelector(".services__main-list");
        if (!tabsContainer || !servicesList) return;
        servicesList.querySelectorAll(".services__main-list-item");
        function filterServices(category) {
            const items = servicesList.querySelectorAll(".services__main-list-item");
            items.forEach((item, index) => {
                const itemCategory = item.dataset.category || "all";
                if (category === "all" || itemCategory === category) {
                    item.style.opacity = "0";
                    item.style.transform = "translateY(20px) scale(0.95)";
                    item.style.transition = "none";
                    item.style.display = "";
                    setTimeout(() => {
                        item.style.transition = "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";
                        item.style.opacity = "1";
                        item.style.transform = "translateY(0) scale(1)";
                    }, index * 100);
                } else {
                    item.style.opacity = "0";
                    item.style.transform = "translateY(20px) scale(0.95)";
                    setTimeout(() => {
                        item.style.display = "none";
                    }, 300);
                }
            });
        }
        tabsContainer.addEventListener("click", function(e) {
            const tabItem = e.target.closest(".tabs__item");
            if (!tabItem) return;
            const category = tabItem.dataset.tab || "all";
            document.querySelectorAll(".tabs__item").forEach(el => el.classList.remove("_active"));
            tabItem.classList.add("_active");
            filterServices(category);
        });
        filterServices("all");
    });
    document.addEventListener("DOMContentLoaded", function() {
        const navContainer = document.querySelector(".home__feed-news-nav");
        const newsList = document.querySelector(".home__feed-news-list");
        if (!navContainer || !newsList) return;
        let animationTimeout = null;
        function filterNews(category) {
            if (animationTimeout) {
                clearTimeout(animationTimeout);
                animationTimeout = null;
            }
            const items = newsList.querySelectorAll(".home__feed-news-item");
            let visibleCount = 0;
            items.forEach(item => {
                item.style.transition = "none";
                item.style.opacity = "";
                item.style.transform = "";
                item.style.display = "";
            });
            void newsList.offsetHeight;
            items.forEach((item, index) => {
                const itemCategory = item.dataset.category || "university";
                const isVisible = category === "all" || itemCategory === category;
                if (isVisible) {
                    visibleCount++;
                    item.style.display = "";
                    item.style.opacity = "0";
                    item.style.transform = "translateY(20px) scale(0.95)";
                    item.style.transition = "none";
                    requestAnimationFrame(() => {
                        animationTimeout = setTimeout(() => {
                            item.style.transition = "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";
                            item.style.opacity = "1";
                            item.style.transform = "translateY(0) scale(1)";
                        }, index * 80);
                    });
                } else {
                    item.style.transition = "none";
                    item.style.opacity = "0";
                    item.style.transform = "translateY(20px) scale(0.95)";
                    item.style.display = "none";
                }
            });
            if (visibleCount === 0) newsList.style.minHeight = "200px"; else newsList.style.minHeight = "";
        }
        function getActiveCategory() {
            const activeItem = navContainer.querySelector(".home__feed-news-nav-item._active");
            if (activeItem) return activeItem.dataset.tab || "all";
            const firstItem = navContainer.querySelector(".home__feed-news-nav-item");
            if (firstItem) {
                firstItem.classList.add("_active");
                return firstItem.dataset.tab || "all";
            }
            return "all";
        }
        navContainer.addEventListener("click", function(e) {
            const navItem = e.target.closest(".home__feed-news-nav-item");
            if (!navItem) return;
            const category = navItem.dataset.tab || "all";
            document.querySelectorAll(".home__feed-news-nav-item").forEach(el => {
                el.classList.remove("_active");
            });
            navItem.classList.add("_active");
            filterNews(category);
        });
        const initialCategory = getActiveCategory();
        filterNews(initialCategory);
    });
    document.addEventListener("DOMContentLoaded", () => {
        const cookie = document.querySelector(".warning-cookie");
        const wrapper = document.querySelector(".wrapper");
        const popup = document.querySelector("#cookie");

        if (!cookie || !wrapper) return;

        const acceptBtn = cookie.querySelector(".button-accept");
        const declineBtn = cookie.querySelector(".button-reject");
        const cookieName = "cookie_consent";

        // Получение cookie
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);

            if (parts.length === 2) {
                return parts.pop().split(";").shift();
            }

            return null;
        }

        // Установка cookie
        function setCookie(name, value, seconds) {
            const date = new Date();
            date.setTime(date.getTime() + seconds * 1000);

            document.cookie =
                `${name}=${value}; ` +
                `expires=${date.toUTCString()}; ` +
                `path=/; ` +
                `SameSite=Lax`;
        }

        // Скрытие cookie-блока
        function closeCookie() {
            wrapper.classList.remove("cookie-active");
            cookie.remove();
        }

        // Показываем cookie только если пользователь еще не сделал выбор
        const consent = getCookie(cookieName);

        if (consent) {
            closeCookie();
        } else {
            cookie.classList.remove("hidden");
            wrapper.classList.add("cookie-active");
        }

        // Принять
        if (acceptBtn) {
            acceptBtn.addEventListener("click", () => {
                const oneYearInSeconds = 365 * 24 * 60 * 60;

                setCookie(
                    cookieName,
                    "accepted",
                    oneYearInSeconds
                );

                closeCookie();
            });
        }

        // Отклонить
        if (declineBtn) {
            declineBtn.addEventListener("click", () => {
                const fiveMinutesInSeconds = 5 * 60;

                setCookie(
                    cookieName,
                    "rejected",
                    fiveMinutesInSeconds
                );

                closeCookie();
            });
        }

        // Если открывается popup #cookie — скрываем cookie-баннер
        if (popup) {
            const observer = new MutationObserver(() => {
                if (popup.classList.contains("popup_show")) {
                    cookie.classList.add("hidden");
                } else if (!getCookie(cookieName)) {
                    cookie.classList.remove("hidden");
                }
            });

            observer.observe(popup, {
                attributes: true,
                attributeFilter: ["class"]
            });
        }
    });
    window["FLS"] = true;
    function initApp() {
        isWebp();
        addTouchClass();
        addLoadedClass();
        menuInit();
        spollers();
        digitsCounter();
        formFieldsInit({
            viewPass: false,
            autoHeight: false
        });
    }
    if (document.readyState === "complete" || document.readyState === "interactive") initApp(); else document.addEventListener("DOMContentLoaded", initApp);
})();