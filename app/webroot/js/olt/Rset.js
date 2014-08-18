/**
 * J. Mulle, for app, 5/14/14 5:16 PM
  * www.introspectacle.net
  * Email: this.impetus@gmail.com
  * Twitter: @thisimpetus
  * About.me: about.me/thisimpetus
  *
  * Rset class
  * @desc
  * @param id
  * @returns {Rset}
  * @constructor
  */


Rset = function (id) {
	// properties
	this.id = id;
	this.params = null;
	this.response = null;
	this.self = this;

	this.e = {
		saveComplete: new CustomEvent(
					"saveComplete", {
						detail: {},
						bubbles: true,
						cancelable: false
					})
	};



	// methods
	this.init = function(id) {
		var data = $.ajax({
			url:cakeUrl("rsets","read", id),
			async:false // jsut this once, and it really SHOULD be loaded before the page loads, I swear
		});
		try {
			data = $.parseJSON(data.responseText);
			this.response = data.response;
			this.params = data.params;
		} catch (e) {
			throw new Error("Unable to initialize Rset from server; exiting...");
		}
	};


	/**
	 * __setValue Private Method
	 * @param obj
	 * @param path
	 * @param value
	 * @param createKeys
	 * @param overwriteKeys
	 * @returns {boolean}
	 * @private
	 */
	this.__setValue = function(obj, path, value, createKeys, overwriteKeys) {
		createKeys = createKeys === true;
		overwriteKeys = overwriteKeys === true;
		var pathParts = typeof(path) === "string" ? splitPath(path, DS) : path;

		if (typeof(pathParts) != "object") { // 3 = minimum depth to reach a valid field in any rset scheme
			throw new Error("Could not create rset representation: path either incorrectly formatted or incomplete.");
		}

		var nextPathElement = pathParts.pop();

		// check for paths to a non-existent location that overwrites an extant, non-object index
		if (typeof(obj[nextPathElement]) != "object" && pathParts.length != 0) {
			if ( (!overwriteKeys || !createKeys) ) {
				throw new Error("Rset not writeable at provided path; either of createKeys or overwriteKeys was false.");
			} else {
				obj[nextPathElement] = {};
			}
		}

		if (pathParts.length == 0) { //last element of the path; now safe to set;
			obj[nextPathElement] = value;
			return true;
		} else {
			if (!(nextPathElement in obj) ) {
			 if (!createKeys) {
				throw new Error("No key found in rset at provided path: [" + nextPathElement + "].");
			 } else {
				 obj[nextPathElement] = {};
			 }
			}
			var remainingObj = obj[nextPathElement];
			this.__setValue(remainingObj, pathParts, value, createKeys, overwriteKeys);
		}

		return true;
	};


	/**
	 * write Method
	 * @desc Writes a response or param to the current Rset object but does NOT save it on the server; multiple writes can
	 *       be executed before saving.
	 * @param path
	 * @param value
	 * @param createKeys
	 * @param overwriteKeys
	 * @returns {*}
	 */
	this.write = function(path, value, createKeys, overwriteKeys) {
		path = typeof(path) === "string" ? splitPath(path, DS) : path;
		var writeTo = path[0] === "params" ? this.params : this.response;
		var result = this.__setValue(writeTo, path.slice(1).reverse(), value, createKeys, overwriteKeys);
		if (result === true) {
			return true;
		} else{
			// was planning on making sure an error was returned to result..
			pr(err.message);
			flash(err.message);
			return false;
		}
	};


	/**
	 * read Method
	 *
	 * @param path
	 * @returns {*}
	 */
	this.read = function(path) {
		return this.__navigate(path,'read', null)
	};


	/**
	 * save Method
	 *
	 * @desc Updates current rset data on server to reflect current state of Rset object
	 * @param path
	 * @param value
	 * @returns {boolean}
	 */
	this.save = function(postData, createKeys, createAfterDepth) {
		var debug = false;
		if (!createKeys) createKeys = false;
		if (!createAfterDepth) createAfterDepth = 0;
		if (debug) pr(postData, "Rset.save:postData");

		return $.post(cakeUrl('rsets','live_update',[id, createKeys, createAfterDepth]), postData, "JSON");
	};


	this.refresh = function(rset) {
		if (!rset) {
			this.init(this.id);
		} else {
			try {
				if (rset.params != "undefined" && rset.response != "undefined") {
					this.param = rset.params;
					this.response = rset.response;
				} else {
					throw new Error("Argument \"rset\" passed to Rset.refresh() does not contain required keys.");
				}
			} catch (e) {
				OLT.fn.flash(e.message);
				pr(e.message);
			}
		}

		return true;
	};


	$(this).on("rsetSaved", null, null, OLT.fn.binds.onRsetSaved);

	this.init(id);
	return this;
};